<?php

namespace App\Models;

use Deiucanta\Smart\Field;
use Deiucanta\Smart\Model;

class PaiementsMethode extends AbstractModel
{
    public $table = "paiements_methode";
	public $primaryKey = "paiementsmethode_id";


    public function fields()
    {
        $fields = parent::fields();

        $fields[] = Field::make('paiementsmethode_label')->string();
        $fields[] = Field::make('paiementsmethode_code')->string();

        return $fields;
    }

	public static function prefix()
    {
        return 'paiementsmethode';
    }

	public function paiements()
	{
		return $this->hasMany('App\Models\Paiements', 'paiements_methode', 'paiementsmethode_id');
	}
}
