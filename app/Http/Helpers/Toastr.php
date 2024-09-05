<?php

namespace App\Http\Helpers;


class Toastr
{
    public static function showToastr()
    {
        return toastr()
            ->closeButton()
            ->preventDuplicates(true)
            ->positionClass('toast-top-center')
            ->newestOnTop(true);
    }
}
