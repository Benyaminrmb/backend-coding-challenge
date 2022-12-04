<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Currencies\BtcController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function initialize():void
    {
        $request=Http::get('https://min-api.cryptocompare.com/data/top/totalvolfull?limit=10&tsym=USD')->json();


        $result=[];
        foreach ($request['Data'] as $key=>$item) {

            $result[$key]['name']=$item['CoinInfo']['FullName'];
            $result[$key]['amount']=$item['RAW']['USD']['PRICE'];
        }

        dd($result);
    }

    public function exclusiveCurrency(Request $request)
    {
        $currency_name=$request->get('currency');
        $currency_controller='App\Http\Controllers\Currencies\BtcController';
    }

}
