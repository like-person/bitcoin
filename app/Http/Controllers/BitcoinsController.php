<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bitcoin;
use App\Library\Services\ApiService;

class BitcoinsController extends Controller
{
    public function bitcoins(){ 
        // Read value from Model method
        $bitcoinData = Bitcoin::getBitcoinList();
        // Pass to view
        return view('bitcoins')->with("bitcoinData",$bitcoinData);
    }
    public function stat(ApiService $api){ 
        $bitcoinStatData = Bitcoin::getBitcoinStat();
        if(count($bitcoinStatData)==0) {
            $bitcoinData = Bitcoin::getBitcoinList();            
            $bitcoinApiStatData = $api->getStatApiBitcoin();
            foreach ($bitcoinData as $bitcoin) {
                $bitcoin->coin_stat_price = $bitcoinApiStatData[$bitcoin->coin_symbol]->stat_price;
                $bitcoin->coin_stat_perc = $bitcoinApiStatData[$bitcoin->coin_symbol]->stat_perc;
                Bitcoin::insertBitcoinStat($bitcoin);
            }
            $bitcoinStatData = Bitcoin::getBitcoinStat();
        }
        // Pass to view
        return view('bitcoinStat')->with("bitcoinStatData",$bitcoinStatData);
    }
    public function statone($symbol='') {
        if(empty($symbol) || $symbol==' ')$bitcoinStatData = Bitcoin::getBitcoinStat();
        else {
            $bitcoinStatData = Bitcoin::getBitcoinStatOne($symbol);
        }
        
        return response()->json(['count'=>count($bitcoinStatData),'data'=>$bitcoinStatData]);
    }
}
