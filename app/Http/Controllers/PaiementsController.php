<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Clients;
use App\Models\ImpotsConfig;
use App\Models\Paiements;
use App\Models\PaiementsMethode;
use App\Models\User;

use App\Services\PaiementsService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class PaiementsController extends Controller
{
	public function __construct(PaiementsService $PaiementsService)
	{
		$this->PaiementsService = $PaiementsService;
	}
    public function index()
    {
		$all = $this->PaiementsService->get_recap(date('Y-m-01'), date('Y-m-t'));
		
        return view('paiements.index', [
				'ca_brut' => $all["ca_brut"],
				'retro' =>  $all["retro"],
				'tab_retros' =>  $all["tab_retros"],
				'ca_net' =>  $all["ca_net"],
				'cs' =>  $all["cs"],
			])
			->with('paiements', $all["paiements"])
			->with('mois', date('m/Y'));
    }

	public function add_form()
	{
		$clients = Clients::get();
		$users = User::whereNotNull('retroconfig')->get();
		$payment_method = PaiementsMethode::get();

		$date = date('Y-m-d');

        return view('paiements.add', ['clients' => $clients, 'users' => $users, 'date' => $date, 'payment_method' => $payment_method]);
	}

	public function add(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'clients_id' => 'required_without:clients_nom,clients_prenom',
            'clients_nom' => 'required_without:clients_id',
            'clients_prenom' => 'required_without:clients_id',
            'paiements_date' => 'required|date',
            'paiements_montant' => 'required|numeric',
            'paiements_methode' => 'required',
            'paiements_user' => 'required',
        ]);
        
        if ($validator->fails()) {
			
			return redirect()->route('add_consultation_form')->withErrors($validator)
			->withInput();
        }
		
		$datas = $validator->validated();
		
		if($datas["clients_id"] == null || $datas["clients_id"])
		{
			//Création du client
			$client = Clients::create([
				'clients_prenom' => $datas["clients_prenom"],
				'clients_nom' => $datas["clients_nom"],
			]);
		}
		else
		{
			$client = Clients::find($datas["clients_id"]);
			if(empty($client))
			{
				return redirect()->route('add_consultation_form')->withInput();
			}
		}

		Paiements::create([
			'paiements_montant' => $datas["paiements_montant"],
			'paiements_date' => $datas["paiements_date"],
			'paiements_methode' => $datas["paiements_methode"],
			'paiements_user' => $datas["paiements_user"],
			'paiements_clients' => $client->clients_id
		]);

		return redirect()->route('current_recap');
	}

	
	public function recap(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'date_start' => 'nullable',
            'date_end' => 'nullable',
        ]);
        
        if ($validator->fails()) {
			
			return redirect()->route('add_consultation_form')->withErrors($validator)
			->withInput();
        }
		
		$datas = $validator->validated();
		
		if(empty($datas))
		{
			$date = date('Y-01-01');
			$date_start = new \DateTime($date);
		}
		else
		{
			$date = $datas['date_start'];
			$date_start = new \DateTime($date);
		}

		if(empty($datas))
		{
			$date = date('Y-m-t');
			$date_end = new \DateTime($date);
		}
		else
		{
			$date = $datas['date_end'];
			$date_end = new \DateTime($date);
		}


		$all = $this->PaiementsService->get_recap($date_start, $date_end);

		return view('paiements.recap', [
			'ca_brut' => $all["ca_brut"],
			'retro' =>  $all["retro"],
			'tab_retros' =>  $all["tab_retros"],
			'ca_net' =>  $all["ca_net"],
			'cs' =>  $all["cs"],
			'date_start' =>  $date_start->format('Y-m-d'),
			'date_end' =>  $date_end->format('Y-m-d'),
		])
		->with('paiements', $all["paiements"])
		->with('date', $date_start->format('d/m/Y') . " - " . $date_end->format('d/m/Y'));
	}
}