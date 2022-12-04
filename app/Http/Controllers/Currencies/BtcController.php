<?php

namespace App\Http\Controllers\Currencies;

use App\Http\Controllers\Controller;
use App\Http\Controllers\currencyAbstract;
use App\Http\Controllers\currencyInterface;
use App\Models\Currency;
use Illuminate\Http\Request;

class BtcController extends currencyAbstract
{
    public function toRial(Currency $currency): int
    {
        return ($currency->amount * 10) + 2;
    }
}
