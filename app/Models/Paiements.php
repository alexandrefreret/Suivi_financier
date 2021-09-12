<?php

namespace App\Models;

use Deiucanta\Smart\Field;
use Deiucanta\Smart\Model;

class Paiements extends AbstractModel
{
    public $table = "paiements";
	public $primaryKey = "paiements_id";

	protected $appends = ['cs'];

    public function fields()
    {
        $fields = parent::fields();

        $fields[] = Field::make('paiements_montant')->decimal(10, 2);
        $fields[] = Field::make('paiements_date')->date();
        $fields[] = Field::make('methode')->belongsTo($this);
        $fields[] = Field::make('user')->belongsTo($this);
        $fields[] = Field::make('clients')->belongsTo($this);
        $fields[] = Field::make('remise_cheques')->belongsTo($this)->nullable();

        return $fields;
    }

	public static function prefix()
    {
        return 'paiements';
    }

	public function methode()
	{
		return $this->belongsTo('App\Models\PaiementsMethode', 'paiements_methode', 'paiementsmethode_id');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User', 'paiements_user', 'id');
	}

	public function clients()
	{
		return $this->belongsTo('App\Models\Clients', 'paiements_clients', 'clients_id');
	}
	
	public function remise_cheques()
	{
		return $this->belongsTo('App\Models\RemiseCheques', 'paiements_remisecheques', 'remisecheques_id');
	}

	public function getCsAttribute()
	{
		$config = ImpotsConfig::where('impotsconfig_start', '<=', $this->paiements_date)
		->where(function($q) {
			return $q->whereNull('impotsconfig_end')->orWhere('impotsconfig_end', '>=', $this->paiements_date);
		})
		->first();
		
		return ($this->paiements_montant * (1 - ($config->impotsconfig_abattement_pourcentage / 100))) * ($config->impotsconfig_acre_pourcentage / 100);
	}
}
