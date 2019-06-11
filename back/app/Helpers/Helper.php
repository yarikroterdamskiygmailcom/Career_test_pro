<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class Helper
{
    public static function receiver($encodedData)
    {
        dd(base64_decode($encodedData));
    }
}