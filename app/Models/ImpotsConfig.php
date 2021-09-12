<?php

namespace App\Models;

use Deiucanta\Smart\Field;
use Deiucanta\Smart\Model;

class ImpotsConfig extends AbstractModel
{
    public $table = "impots_config";
	public $primaryKey = "impotsconfig_id";

    public function fields()
    {
        $fields = parent::fields();

        $fields[] = Field::make('impotsconfig_abattement_pourcentage')->decimal(8,2);
        $fields[] = Field::make('impotsconfig_acre_pourcentage')->decimal(8,2);
        $fields[] = Field::make('impotsconfig_start')->date();
        $fields[] = Field::make('impotsconfig_end')->date()->nullable();

        return $fields;
    }

	public static function prefix()
    {
        return 'impotsconfig';
    }
}
