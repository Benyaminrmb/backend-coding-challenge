<?php

namespace App\Http\Controllers\Currencies;

use App\Http\Controllers\Controller;
use App\Http\Controllers\currencyAbstract;
use App\Http\Controllers\currencyInterface;
use App\Models\Currency;
use Illuminate\Http\Request;

class BitcoinController extends currencyAbstract
{
    /**
     * Override "to-rial" method for custom changes
     * @return int
     */
    public function toRial(): int
    {
        return ($this->currency->amount * 10) + 2;
    }
}
