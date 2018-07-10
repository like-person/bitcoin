<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Bitcoin extends Model
{
    public static function getBitcoinList(){
        $value=DB::table('coin_type')->get();
        return $value;
    }
    public static function getApiList(){
        $value=DB::table('coin_stat_source')->get();
        return $value;
    }
    public static function getBitcoinArr(){
        $list = self::getBitcoinList();
        $bitcoinArr = [];
        foreach ($list as $bitcoin) {
            $bitcoinArr[] = $bitcoin->coin_symbol;
        }
        return $bitcoinArr;
    }
    public static function getBitcoinStat(){        
        $from = date("Y-m-d 00:00:00");
        $to = date("Y-m-d 00:00:00",(time()+86400));
        $results = DB::table('coin_stat')
                ->join('coin_type', 'coin_stat.coin_symbol', '=', 'coin_type.coin_symbol')
                ->whereBetween('coin_stat_datetime', [$from, $to])
                ->orderBy('coin_stat_perc', 'abs')
                ->get();
        return $results;
    }
     public static function getBitcoinStatOne($coin_name){        
        $from = date("Y-m-d 00:00:00");
        $to = date("Y-m-d 00:00:00",(time()+86400));
        $results = DB::table('coin_stat')
                ->join('coin_type', 'coin_stat.coin_symbol', '=', 'coin_type.coin_symbol')
                ->whereBetween('coin_stat_datetime', [$from, $to])
                ->where('coin_type.coin_name', 'like', $coin_name)
                ->orderBy('coin_stat_perc', 'abs')
                ->get();
        return $results;
    }
    public static function insertBitcoinStat($bitcoin){
        $old_stat_price = $bitcoin->coin_stat_price;
        $old_stat_perc = $bitcoin->coin_stat_perc;
        $oldData = DB::table('coin_stat')
                ->where('coin_symbol', $bitcoin->coin_symbol)
                ->orderBy('coin_stat_id', 'desc')
                ->first();
        if(isset($oldData->coin_stat_price)){
            $old_stat_price = $oldData->coin_stat_price;
            $old_stat_perc = $oldData->coin_stat_perc;
            DB::table('coin_stat')->where('coin_symbol', $bitcoin->coin_symbol)->delete();
        }
        $r1 = DB::insert('insert into coin_stat (coin_symbol, coin_stat_price, coin_stat_perc, old_stat_price, old_stat_perc) values ( ?, ?, ?, ?, ?)', [$bitcoin->coin_symbol, $bitcoin->coin_stat_price, $bitcoin->coin_stat_perc, $old_stat_price, $old_stat_perc]);
        $r2 = DB::insert('insert into coin_history (coin_symbol, coin_stat_price, coin_stat_perc) values ( ?, ?, ?)', [$bitcoin->coin_symbol, $bitcoin->coin_stat_price, $bitcoin->coin_stat_perc]);
        return $r1 && $r2;
    }
}
