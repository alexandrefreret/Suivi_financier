<?php

namespace App\Services;

use App\Models\Paiements;
use App\Models\ImpotsConfig;

class PaiementsService
{
	public function __construct()
	{
		
	}

	public function get_recap($date_start, $date_end)
	{
		$paiements = Paiements::where('paiements_date', '>=', $date_start)
			->where('paiements_date', '<=', $date_end)
			->with(['user', 'methode', 'clients', 'user.retro_config', 'remise_cheques'])
			->get();
		
		$ca_brut = $paiements->sum('paiements_montant');
		$cs = round($paiements->sum('cs'), 2);
		
		$retro = $paiements->sum(function($t){
			return $t->paiements_montant * ($t->user->retro_config->retroconfig_pourcentage /100); 
		});

		$tab_retros = [];
		foreach ($paiements as $key => $value)
		{
			if(!isset($tab_retros[$value->user->id]))
			{
				$tab_retros[$value->user->id] = [
					"montant" => 0,
					"user" => $value->user->name . " " . $value->user->firstname
				];
			}

			$tab_retros[$value->user->id] = [
				"montant" => $tab_retros[$value->user->id]["montant"] + ( $value->paiements_montant * ($value->user->retro_config->retroconfig_pourcentage /100)),
				"user" => $value->user->name . " " . $value->user->firstname
			];
		}
		
		$ca_net = $ca_brut - $retro - $cs;

		return [
			"ca_brut" => $ca_brut,
			"ca_net" => $ca_net,
			"retro" => $retro,
			"cs" => $cs,
			"paiements" => $paiements,
			"tab_retros" => $tab_retros,
			"retro" => $retro,
		];
	}
}