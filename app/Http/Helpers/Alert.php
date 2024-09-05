<?php

namespace App\Http\Helpers;


class Alert
{
    public static function showAlert()
    {
        return sweetalert()
            ->timer(3000);
    }
}
