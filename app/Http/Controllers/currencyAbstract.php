<?php

namespace App\Http\Controllers;

use App\Models\Currency;

class currencyAbstract implements currencyInterface
{
    public Currency $currency;

    /**
     * Get current currency
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->currency=$currency;
    }


    /**
     * Default "to-rial" method for all currencies
     * @return int
     */
    public function toRial(): int
    {
        return $this->currency->amount*10;
    }
}
