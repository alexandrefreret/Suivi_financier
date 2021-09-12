<?php

namespace App\Models;

use Deiucanta\Smart\Field;
use Deiucanta\Smart\Model;

class RetrocessionConfig extends AbstractModel
{
    public $table = "retrocession_config";
	public $primaryKey = "retrocessionconfig_id";

    public function fields()
    {
        $fields = parent::fields();

        $fields[] = Field::make('retroconfig_pourcentage')->decimal(8,2);

        return $fields;
    }

    public static function prefix()
    {
        return 'retroconfig';
    }
}
