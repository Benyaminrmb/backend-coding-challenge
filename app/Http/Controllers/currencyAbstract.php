<?php

namespace App\Http\Controllers;

use App\Models\Currency;

class currencyAbstract extends Controller implements currencyInterface
{
    public int $exchange=0;
    public function __construct()
    {


    }


    /**
     * Default "to-rial" method for all currencies
     * @return int
     */
    public function toRial(): int
    {
        return $currency->amount*10;
    }
}
