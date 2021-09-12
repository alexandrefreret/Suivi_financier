<?php

namespace App\Models;

use Deiucanta\Smart\Field;
use Deiucanta\Smart\Model;

class RemiseCheques extends AbstractModel
{
    public $table = "remise_cheques";
	public $primaryKey = "remisecheques_id";

    public function fields()
    {
        $fields = parent::fields();

        $fields[] = Field::make('remisecheques_numero')->string();
        $fields[] = Field::make('remisecheques_date')->date();

        return $fields;
    }

	public static function prefix()
    {
        return 'remisecheques';
    }

    public function paiements()
    {
        return $this->hasMany('App\Models\Paiements', 'paiements_remisecheques', 'remisecheques_id');
    }
}
