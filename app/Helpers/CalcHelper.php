<?php

namespace App\Helpers;

class CalcHelper
{
    public static function total_price($carts = null)
    {
        $result = 0;

        if ($carts)
            $result = $carts->whereHas('product', fn ($q) => $q->ready())
                ->sum(fn ($q) => $q->amount * $q->product->price);

        return $result;
    }
}
