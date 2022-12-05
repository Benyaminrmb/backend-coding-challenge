<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Currencies\BitcoinController;
use App\Http\Resources\CurrencyResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Url-address of provider
     * @var string
     */
    private string $provider_url = 'https://min-api.cryptocompare.com/data/top/totalvolfull?limit=5&tsym=USD';

    /**
     * create currencies at very beginning
     * @return mixed
     */
    public function initialize()
    {
        $request = Http::get($this->provider_url)->json();
        $data = $this->createCurrencyData($request['Data']);
        $result = $this->saveCurrencies($data);
        return $this->response($result);
    }

    /**
     * Collect all currencies
     * @return mixed
     */
    public function getCurrencies()
    {
        $currency_controller = new CurrencyController();
        $data = $currency_controller->getCurrencies();
        return $this->response(CurrencyResource::collection($data));
    }

    /**
     * Response generator
     * @param $data
     * @param $status
     * @param $message
     * @return mixed
     */
    public function response($data, $status = true, $message = null)
    {
        $response_type = $this->responseType();

        if ($response_type === 'xml') {
            $data = helper_to_array($data);
        }

        return response()->$response_type([
            'status' => $status,
            'data' => $data,
            'message' => $message
        ]);
    }


    /**
     * Fetch indexes from provider
     * @param $response_data
     * @return array
     */
    public function createCurrencyData($response_data): array
    {
        $result = [];
        foreach ($response_data as $key => $item) {
            $result[$key]['name'] = $item['CoinInfo']['FullName'];
            $result[$key]['amount'] = $item['RAW']['USD']['PRICE'];
        }
        return $result;
    }

    /**
     * Store Currencies
     * @param array $result
     * @return int
     */
    public function saveCurrencies(array $result): int
    {
        $currency_controller = new CurrencyController();
        return $currency_controller->store($result);
    }

    /**
     * Get type of response ( json | xml )
     * @return string
     */
    public function responseType(): string
    {
        return Config::get('response-type');
    }

}
