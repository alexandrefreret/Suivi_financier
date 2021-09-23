<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Paiements;
use App\Models\Clients;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tab_ca = [];
        $tab_ca_last = [];
        $tab_patients = [];
        $tab_patients_last = [];
        for ($month = 1; $month < 12; $month++)
        { 
            $month = str_pad($month, 2, '0', STR_PAD_LEFT);

            $paiements_current = Paiements::where("paiements_date", 'like', date('Y-' . $month . "-%"))->get();
            $paiements_last_year = Paiements::where("paiements_date", 'like', date('Y-' . $month . "-%", strtotime("-1 year")))->get();
            $tab_ca[] = $paiements_current->sum("paiements_montant");
            $tab_ca_last[] = $paiements_last_year->sum("paiements_montant");
            
            $tab_patients[] = $paiements_current->count("paiements_id");
            $tab_patients_last[] = $paiements_last_year->count("paiements_id");

            $new_clients_current = Clients::where("clients_inserted", 'like', date('Y-' . $month . "-%"))->get();
            $new_clients_last_year = Clients::where("clients_inserted", 'like', date('Y-' . $month . "-%", strtotime("-1 year")))->get();
            $new_tab_patients[] = $new_clients_current->count("clients_id");
            $new_tab_patients_last[] = $new_clients_last_year->count("clients_id");
        }
        
        return view('dashboard', [
            'title' => 'Tableau de bord', 
            'tab_ca' => $tab_ca, 
            'tab_ca_last' => $tab_ca_last, 
            'year_current' => date('Y'), 
            'year_last' => date('Y', strtotime("-1 year")),

            'new_tab_patients' => $new_tab_patients,
            'new_tab_patients_last' => $new_tab_patients_last,

            'tab_patients' => $tab_patients,
            'tab_patients_last' => $tab_patients_last,
        ]);
    }
}
