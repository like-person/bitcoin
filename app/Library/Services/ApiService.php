<?php
namespace App\Library\Services;

use App\Bitcoin;
use GuzzleHttp;

class ApiService
{
    protected $bitcoinArr;
    protected $bitcoinApi;
    protected $cntApi;
    
    function __construct() {
        $this->bitcoinArr = Bitcoin::getBitcoinArr();
        $this->bitcoinApi = Bitcoin::getApiList();
        $this->cntApi = count($this->bitcoinApi);
    }
    public function getStatApiBitcoin()
    {
        $bitcoinStatData = [];
        $client = new GuzzleHttp\Client();
        foreach ($this->bitcoinApi as $api) {
            $res = $client->get($api->coin_stat_source_api);
            $bitcoinStatData[$api->coin_stat_source_id] = [];
            if($res->getStatusCode()==200) {                
                $apiData = json_decode($res->getBody());
                switch ($api->coin_stat_source_type) {
                    case 'data':
                        foreach ($apiData->data as $apiVals) {
                            if (!in_array($apiVals->symbol, $this->bitcoinArr))
                                continue;
                            $data = [
                                'coin_name' => $apiVals->name,
                                'coin_cymbol' => $apiVals->symbol,
                                'stat_price' => $apiVals->quotes->USD->price,
                                'stat_perc' => $apiVals->quotes->USD->percent_change_24h,
                            ];
                            $bitcoinStatData[$apiVals->symbol][$api->coin_stat_source_id] = (object) $data;
                        }
                        break;
                    default:
                        foreach ($apiData as $apiVals) {
                            if (!in_array($apiVals->short, $this->bitcoinArr))
                                continue;
                            $data = [
                                'stat_price' => $apiVals->price,
                                'stat_perc' => $apiVals->cap24hrChange,
                            ];
                            $bitcoinStatData[$apiVals->short][$api->coin_stat_source_id] = (object) $data;
                        }
                        break;
                }               
            }            
        }
        if(count($bitcoinStatData)>0){
            
            $bitcoinAverageData = [];
            foreach ($this->bitcoinArr as $bitcoin) {                
                foreach ($bitcoinStatData[$bitcoin] as $key => $stat) {
                    if(!isset($bitcoinAverageData[$bitcoin])) {
                        $bitcoinAverageData[$bitcoin] = $stat;
                    }else {
                        $bitcoinAverageData[$bitcoin]->stat_price = $bitcoinAverageData[$bitcoin]->stat_price + $stat->stat_price;
                        $bitcoinAverageData[$bitcoin]->stat_perc = $bitcoinAverageData[$bitcoin]->stat_perc + $stat->stat_perc;
                    }
                }
                if($this->cntApi>1){
                    $bitcoinAverageData[$bitcoin]->stat_price = $bitcoinAverageData[$bitcoin]->stat_price / $this->cntApi;
                    $bitcoinAverageData[$bitcoin]->stat_perc = $bitcoinAverageData[$bitcoin]->stat_perc / $this->cntApi;
                }
            }            
        }
        return $bitcoinAverageData;
    }
}