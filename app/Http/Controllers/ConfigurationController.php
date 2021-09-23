<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\ImpotsConfig;
use App\Models\User;

use App\Services\PaiementsService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class ConfigurationController extends Controller
{
	public function __construct(PaiementsService $PaiementsService)
	{
		$this->PaiementsService = $PaiementsService;
	}
    public function index()
    {
		$all = $this->PaiementsService->get_recap(date('Y-m-01'), date('Y-m-t'));
		
        return view('configuration.index', [
		]);
			// ->with('paiements', $all["paiements"]);
    }
}