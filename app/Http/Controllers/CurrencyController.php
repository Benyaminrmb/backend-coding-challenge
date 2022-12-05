<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CurrencyController extends Controller
{
    /**
     * Create new currencies at one query (upsert)
     * @param $data
     * @return int
     */
    public function store($data)
    {
        $validator = Validator::make($data, [
            '*.name' => 'required|string|unique:currencies,name|max:50',
            '*.amount' => 'required|numeric',
        ], [
            '*.name' => [
                'required' => 'You should definitely define a name for your currency.',
                'string' => "You need a *string* type for your currency name right ?",
                'unique' => 'This currency name has been already saved.',
                'max' => "How long is your currency name ? maximum length is 50 characters"
            ],
            '*.amount' => [
                'required' => "Name your currency price cuz its required.",
                'amount' => "All we accept as currency amount is number"
            ]
        ]);
        if ($validator->fails()) {
            //Todo xml-mode : when we have tag name like 0.name or 1.name ( its false for create tag )
            $response = $this->response($validator->errors(), false);
            throw new HttpResponseException($response);
        }
        return Currency::upsert($validator->validated(), ['name', 'amount']);
    }

    /**
     * Fetch all currencies
     * @return array
     */
    public function getCurrencies()
    {
        $currencies = Currency::all();
        $result = [];
        foreach ($currencies as $key => $currency) {
            $result[$key] = $currency;
            $result[$key]['to_rial'] = $this->getCurrencyRial($currency);
        }
        return $result;
    }

    /**
     * get currency Rial amount
     * @param Currency $currency
     * @return mixed
     */
    public function getCurrencyRial(Currency $currency)
    {
        $currency_controller = $this->currencyController($currency);
        return $currency_controller->toRial();
    }

    /**
     * create currency controller by their name.
     * dynamic fetch *
     * @param Currency $currency
     * @return mixed
     */
    public function currencyController(Currency $currency): mixed
    {
        $class_name = 'App\Http\Controllers\Currencies\\' . Str::camel(Str::replace('.', '', $currency->name)) . 'Controller';
        return new $class_name($currency);
    }

}
