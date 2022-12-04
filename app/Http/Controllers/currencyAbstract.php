<?php

namespace App\Http\Controllers;

use App\Models\Currency;

class currencyAbstract extends Controller implements currencyInterface
{
    public int $exchange=0;
    public function __construct()
    {


    }


    public function toRial(Currency $currency): int
    {
        return $currency->amount*10;
    }
}
