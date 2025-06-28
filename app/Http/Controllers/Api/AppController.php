<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Users;
use App\Models\Apps;
use App\Classes\Base64;
use DB;
use Mail, GeoIP;
use Illuminate\Support\Str;
use File, Image;

class AppController extends Controller
{

    function index(Request $request){
        $userid = $request->uid;
        $req=json_decode(base64_decode(base64_decode(request()->data)),true);
        $user=Users::find($userid);

        $data = Apps::get();
        return response(['msg' => "App list fetched", 'code' => 201,'data'=>$data]);
        
    }
    
    function add_result(Request $request){
        $userid = $request->uid;
        
        $user = Users::find($userid);
        $app_id = $request->app_id;
        $coin = $request->coin;
        $total = $user->balance + $coin;
        $user->balance = $total;
        
        DB::table('transaction')->insert([
            'tran_type' => 'credit',
            'user_id' => $userid,
            'app_id' => $app_id,
            'amount' => $coin,
            'type' => "Scratch App",
            'ip' => $this->getUserIpAddr(),
            'remained_balance' => $total,
            'remarks' => "Claim From Scrach App",
            'inserted_at'=>Carbon::now()
        ]);
        $user->save();
        
        return $this->respOk($coin .' '. $this->getResponseMsg('bonus_received'), $total);
    }

    public function getUserIpAddr()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    function respOk($msg, $coin)
    {
        return response(['msg' => $msg, 'balance' => $coin, 'code' => 201]);
    }
    
    function getResponseMsg($key){
        $lang=(request()->header('lang')==null || request()->header('lang')=='') ? 'en' : request()->header('lang');
        return DB::table('lang_text')->where(['lang'=>$lang,'txt_key'=>$key])->get()->first()->txt_value;
    }
}
