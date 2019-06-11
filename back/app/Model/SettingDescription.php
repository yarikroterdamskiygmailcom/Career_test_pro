<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SettingDescription extends Model
{
    protected $table = 'settings_description';

    protected $fillable = [
        'setting_id', 'value', 'language_id'
    ];
}
