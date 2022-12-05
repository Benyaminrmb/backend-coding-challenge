<?php

namespace App\Http\Controllers;

use App\Models\Currency;

interface currencyInterface
{
    /**
     * force all currencies for add "to-rial" method in their controller
     * @return int
     */
    public function toRial():int;
}
