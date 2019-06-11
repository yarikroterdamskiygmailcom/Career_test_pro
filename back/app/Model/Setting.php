<?php

namespace App\Model;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'keyname'
    ];

    /**
     * Get the setting value record associated with the setting id.
     */
    protected $with = ['setting_description'];

    public function setting_description()
    {
        return $this->hasOne('App\Model\SettingDescription');
    }
}
