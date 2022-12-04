<?php

namespace App\Http\Controllers;

use App\Models\Currency;

interface currencyInterface
{
    public function toRial(Currency $currency):int;
}
