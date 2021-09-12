<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Paiements;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
    	$paiements = Paiements::where('paiements_date', '>=', date('Y-m-d'))
			->where('paiements_date', '<=', date('Y-m-d'))
			->with(['user', 'methode'])
			->get();

		// // echo '<pre>'; var_dump($paiements->first()->user); echo'</pre>';

		foreach ($paiements as $key => $value) {
			dd($value->user);
		}
    }
}
