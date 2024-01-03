<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class StringHelper
{
    public static function abb($string)
    {
        return Str::of($string)->substr(0, 1)->upper()->value . Str::of($string)->substr(-1, 1)->upper()->value;
    }

    public static function currency($number, $with_curr = false, $curr = 'Rp. ', $order = 'first')
    {
        $fix_number = number_format($number, 0, ',', '.');
        if ($with_curr == true)
            if ($order == 'first')
                return $curr . $fix_number;
            else
                return $fix_number . $curr;

        return $fix_number;
    }
}
