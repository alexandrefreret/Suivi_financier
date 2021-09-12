<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Clients;
use App\Models\ImpotsConfig;
use App\Models\Paiements;
use App\Models\PaiementsMethode;
use App\Models\RemiseCheques;
use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class RemiseChequesController extends Controller
{
    public function index()
    {
		$remise_cheques = RemiseCheques::with(['paiements'])->orderBy('remisecheques_date', 'DESC')->get();

        return view('remise_cheques.index', ['remise_cheques' => $remise_cheques]);
			// ->with('paiements', $paiements)
			// ->with('mois', date('m/Y'));
    }

	public function add_form()
	{
		$paiements = Paiements::whereNull('paiements_remisecheques')->whereHas('methode', function ($query) {
			$query->where('paiementsmethode_code', '=', 'CH');
		})
		->with(['clients'])
		->get();
		
		$date = date('Y-m-d');

        return view('remise_cheques.add', ['paiements' => $paiements, 'date' => $date]);
	}

	public function add(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'paiements_ids' => 'required|array',
            'remisecheques_date' => 'required|date',
            'remisecheques_numero' => 'required',
        ]);
        
        if ($validator->fails()) {
			return redirect()->route('add_remise_cheques_form')->withErrors($validator)
			->withInput();
        }
		
		$datas = $validator->validated();
		
		$remise_cheques = RemiseCheques::create([
			'remisecheques_date' => $datas["remisecheques_date"],
			'remisecheques_numero' => $datas["remisecheques_numero"],
		]);

		Paiements::whereIn('paiements_id', $datas["paiements_ids"])->update(['paiements_remisecheques' => $remise_cheques->remisecheques_id]);

		return redirect()->route('current_recap');
	}
}