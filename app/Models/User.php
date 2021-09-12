<?php

namespace App\Models;

use Deiucanta\Smart\Field;
use Deiucanta\Smart\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends AbstractAuthenticable
{
    

    protected $table = "users";
    public $primaryKey = "id";

    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function fields()
    {
        $fields = parent::fields();

        $fields[] = Field::make('firstname')->string();
        $fields[] = Field::make('retro_config')->belongsTo($this)->nullable();

        return $fields;
    }

    static public function isSoftDeletable()
    {
        return false;
    }

    static public function prefix()
    {
        return '';
    }

    public function retro_config()
    {
        return $this->belongsTo('App\Models\RetrocessionConfig', 'retroconfig', 'retroconfig_id');
    }

    public function paiements()
    {
        return $this->hasMany('App\Models\Paiements', 'paiements_user', 'id');
    }
}
