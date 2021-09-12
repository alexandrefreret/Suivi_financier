<?php

namespace App\Models;

use Deiucanta\Smart\Field;
use Deiucanta\Smart\Model;

class Clients extends AbstractModel
{
    public $table = "clients";
	public $primaryKey = "clients_id";

    public function fields()
    {
        $fields = parent::fields();

        $fields[] = Field::make('clients_nom')->string();
        $fields[] = Field::make('clients_prenom')->string();

        return $fields;
    }

	public static function prefix()
    {
        return 'clients';
    }
}
