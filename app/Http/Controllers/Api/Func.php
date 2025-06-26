<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
use App\Models\Users;
use App\Models\TaskApi;
use App\Models\Video;
use App\Models\Offerwall;
use App\Models\Apps;
use App\Models\RedeemCat;
use App\Models\Redeem;
use App\Models\Weblink;
use App\Models\Social;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\Auth;
use App\Services\CacheManager;
use Illuminate\Filesystem\Cache;

class Func extends Controller
{
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
    
    function get_global_msg($id){
        return response(DB::table('global_msg')->where(['user_id'=>$id])->limit(1)->orderBy('id','DESC')->get());
    }    
    
    function global_msg_update($id){
        if(DB::table('global_msg')->where('id',$id)->count()==1){
             DB::table('global_msg')->where('id',$id)->delete();
        }
        return response(['code'=>201]);
    }
    
    public function initCr(Request $req)
    {
        $req = Auth\Lib::decrypt(urldecode(request()->data));
        
    
         DB::table('lang_text')->where('lang','en')->get()->first()->txt_value;
        
        if($req==null){
            return $this->respError(Func::getResponseMsg('something_went_wrong'));
        }
        
        $uid = $req['ex_id'];
        $taskId = $req['id'];
        $type = $req['type'];
        $date = Carbon::now();
        $count = 0;

        switch ($type) {
            case 2:
                return $this->redeem($req);
                break;
            
            case 22:
                return $this->redeemNew($req);
                break;

            case 3:
                return $this->daily($uid);
                break;

            case 4:
                return $this->checkSpin($uid, $taskId);
                break;

            case 5:
                return $this->aps($uid);
                break;

            case 6:
                return $this->vdo($uid);
                break;

            case 7:
                return $this->web($uid);
                break;

            case 8:
                return $this->spn($uid, $taskId, $req['ex']);
                break;

            case 9:
                return $this->crWeb($uid, $taskId);
                break;

            case 10:
                return $this->crVid($uid, $taskId);
                break;

            case 11:
                return $this->crApp($uid, $taskId);
                break;

            case 12:
                return $this->history($uid);
                break;

            case 13:
                return $this->Rewardhistory($uid);
                break;

            case 14:
                return $this->crGame($uid, $taskId);
                break;

            case 15:
                return $this->checkScratch($uid, $taskId);
                break;
        }
    }
    
    function get_hotoffer($id){
        $data = DB::select('Select hot_offer.id,hot_offer.title,coin,hot_offer.image,hot_offer.url,hot_offer.description
                    from hot_offer left outer join hotoffer_data on
                hotoffer_data.user_id =:ids and hot_offer.id = hotoffer_data.task_id
                where hot_offer.status=0 and
                hotoffer_data.task_id is NULL and hot_offer.status=0
                ORDER BY hot_offer.id DESC limit 15', ['ids' => $id]);
        return response()->json($data);
    }
        
    function get_offerwall(){
        return response(CacheManager::getOfferwall());
    } 
     
    function get_lang_data($lang){
        return response(DB::table('lang_text')->where('type','!=','server')->where('lang',$lang)->select('txt_value')->get());
    }
    
    function get_lang(){
        return response(DB::table('lang')->where('status',0)->get());
    }
        
    public function daily($uid)
    {
        $user = Users::find($uid);
        $user = $this->checkTaskStatus($user);
        if ($this->itsToday($user->dcheck)) {
            $user->dcheck = date('Y-m-d');
            $total = $user->balance + env('daily');
            $user->balance = $total;
            $this->insActivity('daily', env('daily'), $total, $uid);
            $user->save();
            return $this->respOk(env('daily') .' '. $this->getResponseMsg('bonus_received'), $total);
        } else {
            return $this->respError($this->getResponseMsg('today_daily_bonus_already_claimed'));
        }
    }
    
    function checkSpin($uid, $taskId)
    {
        $user = Users::find($uid);
        $user = $this->checkTaskStatus($user);
        if ($taskId == 1) {
            if ($user->spn < env('spn')) {
                return $this->respSpinOk(($user->spn - env('spn')), env('spn'),env('SPIN_INTERVAL'));
            } else {
                return $this->respError($this->getResponseMsg('today_task_limit_completed'));
            }
        } else if ($taskId == 2) {
            if ($user->math < env('mathLimit')) {
                return $this->respSpinOk(($user->math - env('mathLimit')), env('mathLimit'),env('QUIZ_INTERVAL'));
                
            } else {
                return $this->respError($this->getResponseMsg('today_task_limit_completed'));
            }
        }else if ($taskId == 3) {
            if ($user->scratch < env('scratch')) {
                return response(['count' => ($user->scratch - env('scratch')), 'limit' => env('scratch'),
                'data'=>env('scratch_coin'),'interval'=>env('SCRATCH_INTERVAL'), 'code' => 201]);
            } else {
                return $this->respError($this->getResponseMsg('today_task_limit_completed'));
            }
        }
    }

    function spn($uid, $taskId, $type)
    {
        $user = Users::find($uid);
        if ($type == 1) {
            if ($user->spn < env('spn')) {
                
                $spin = CacheManager::getSpinConfig();
                
                if($taskId == $spin->position_1 || $taskId == $spin->position_2 || $taskId == $spin->position_3 || $taskId == $spin->position_4 || $taskId == $spin->position_5 || $taskId == $spin->position_6 || $taskId == $spin->position_7 || $taskId == $spin->position_8){
                    $user->spn += +1;
                    $total = $user->balance + $taskId;
                    $user->balance = $total;
                    $this->insActivity('spn', $taskId, $total, $uid);
                    $user->save();
    
                    return $this->respOk($taskId .' '.  $this->getResponseMsg('bonus_received'), $total);
                              
                }else{
                    return $this->respError('Please restart app and complete again task'.$taskId.'-'.$spin->position_8);         
                }
                
            } else {
                return $this->respError($this->getResponseMsg('today_task_limit_completed'));
            }
        } else if ($type == 2) {
            if ($user->math < env('mathLimit')) {
                
                $user->math += +1;
                $total = $user->balance + env('mathCoin');
                $user->balance = $total;
                $this->insActivity('math', env('mathCoin'), $total, $uid);
                $user->save();

                return $this->respOk(env('mathCoin') .' '. $this->getResponseMsg('bonus_received'), $total);
            } else {
                return $this->respError($this->getResponseMsg('today_task_limit_completed'));
            }
        } else {
            if ($user->scratch < env('scratch')) {
                
                $a=explode(',',env('scratch_coin'));
                if($taskId > $a[1]){
                    return $this->respError('Please restart app and complete again task');                   
                }

                
                $user->scratch += +1;
                $total = $user->balance + $taskId;
                $user->balance = $total;
                $this->insActivity('scratch', $taskId, $total, $uid);
                $user->save();

                return $this->respOk($taskId .' '. $this->getResponseMsg('bonus_received'), $total);
            } else {
                return $this->respError($this->getResponseMsg('today_task_limit_completed'));
            }
        }
    }

    function insActivity($type, $coin, $total, $id)
    {
        $msg = "";
        switch ($type) {
            case 'daily':
                $msg = "Daily Checkin";
                $remark = $this->getResponseMsg('daily_bonus_remark');
                break;

            case 'spn':
                $msg = "Lucky Spin";
                $remark = $this->getResponseMsg('spin_bonus_remark');
                break;
            
             case 'scratch':
                $msg = "Scratch Card";
                $remark = $this->getResponseMsg('scratch_bonus_remark');
                break;

            case 'video':
                $msg = "Video Tutorial";
                $remark = $this->getResponseMsg('video_bonus_remark');
                break;

            case 'web':
                $msg = "Article";
                $remark = $this->getResponseMsg('article_bonus_remark');
                break;

            case 'app':
                $msg = "Offers";
                $remark = $this->getResponseMsg('offer_bonus_remark');
                break;

            case 'redeem':
                $msg = "Redeem";
                $remark = $this->getResponseMsg('redeem_remark');
                break;

            case 'game':
                $msg = "Game";
                $remark = $this->getResponseMsg('game_remark');
                break;
            case 'math':
                $msg = "Quiz";
                $remark =$this->getResponseMsg('quiz_remark');
                break;
        }


        DB::table('transaction')->insert([
            'tran_type' => 'credit',
            'user_id' => $id,
            'amount' => $coin,
            'type' => $msg,
            'ip' => $this->getUserIpAddr(),
            'remained_balance' => $total,
            'remarks' => $remark,
            'inserted_at'=>Carbon::now()
        ]);
    }
    
    function getResponseMsg($key){
        $lang=(request()->header('lang')==null || request()->header('lang')=='') ? 'en' : request()->header('lang');
        return DB::table('lang_text')->where(['lang'=>$lang,'txt_key'=>$key])->get()->first()->txt_value;
    }

    function respOk($msg, $coin)
    {
        return response(['msg' => $msg, 'balance' => $coin, 'code' => 201]);
    }

    function respError($msg)
    {
        return response(['msg' => $msg, 'code' => 400]);
    }

    function itsToday($to)
    {
        if ($to == date('Y-m-d')) {
            return false;
        } else {
            return true;
        }
    }

    function checkTaskStatus($user)
    {
        if ($user->td == date('Y-m-d')) {
            return $user;
        } else {
            $user->spn = 0;
            $user->web = 0;
            $user->video = 0;
            $user->math = 0;
            $user->scratch = 0;
            $user->td = date('Y-m-d');
            $user->save();

            return $user;
        }
    }

    function web($uid)
    {
        $user = Users::find($uid);
        $user = $this->checkTaskStatus($user);
        $avil = env('web') - $user->web;
        if ($avil < 0) {
            return [];
        }
        $data = DB::select('Select weblink.id,
                            title,
                            url,
                            status,
                            point,
                            browser_type,
                            timer 
                            from weblink 
                        left outer join task on 
                        task.user_id =:ids 
                        and 
                        weblink.id = task.task_id
                        and 
                        task.type=4
                        where
                        task.task_id is NULL
                        and 
                        weblink.status=0 
                        ORDER BY weblink.id DESC limit :lim', ['ids' => $uid, 'lim' => $avil]);
        return $data;
    }

    function vdo($uid)
    {
        $user = Users::find($uid);
        $user = $this->checkTaskStatus($user);
        $avil = env('video') - $user->video;

        if ($avil < 0) {
            return [];
        }
        $data = DB::select('Select youtube_video.id,url,youtube_video.video_id,browser_type,title,timer,status,point from youtube_video left outer join task on task.user_id =:ids and youtube_video.id = task.task_id and task.type=1 where task.task_id is NULL and status=0 ORDER BY youtube_video.id DESC limit :lim', ['ids' => $uid, 'lim' => $avil]);

        return $data;
    }

    function checkTask(Users $user, $type)
    {
        if ($this->itsToday($user->td)) {
            switch ($type) {
                case 'web':
                    if ($user->web >= env('web')) {
                        return $this->respError($this->getResponseMsg('today_task_limit_completed'));
                    }
                    break;
                case 'video':
                    if ($user->video >= env('video')) {
                        return $this->respError($this->getResponseMsg('today_task_limit_completed'));
                    }
                    break;

                case 'app':
                    if ($user->app >= env('app')) {
                        return $this->respError($this->getResponseMsg('today_task_limit_completed'));
                    }
                    break;
            }
        }
    }

    function crGame($uid, $taskId)
    {
        if ($this->countTask(6, $taskId, $uid, date('Y-m-d')) == 0) {
            $user = Users::find($uid);
            
            if($game=DB::table('games')->where('id',$taskId)->select('coin','played_user')->first()){
                $coin=$game->coin;
                $total = $user->balance + $coin;
                $user->balance = $total;
                $this->insActivity('game', $coin, $total, $uid);
                $user->save();
                DB::table('games')->where('id',$taskId)->update(['played_user'=>($game->played_user+1)]);
                $this->taskLog(6, $taskId, $uid);
                return $this->respOk($coin.' '. $this->getResponseMsg('bonus_received'), $total);
                
            }else{
                return $this->respError("Oops Game not found");
            }
            
        } else {
            return $this->respError($this->getResponseMsg('game_point_already_claimed'));
        }
    }

    function crWeb($uid, $taskId)
    {
        $user = Users::find($uid);
        $this->checkTask($user, 'web');
        if ($user->web < env('web')) {
            
            if (TaskApi::where(['type' => 4, 'task_id' => $taskId, 'user_id' => $uid])->count() > 0) {
                return $this->respError($this->getResponseMsg('bonus_already_claimed'));
            }
            
            $web = Weblink::find($taskId);
            $coin = $web->point;
            $user->web += +1;
            $total = $user->balance + $coin;
            $user->balance = $total;
            $this->insActivity('web', $coin, $total, $uid);
            $user->save();
            $web->views += +1;
            $web->save();
            $this->taskLog(4, $taskId, $uid);
            return $this->respOk($coin .' '.$this->getResponseMsg('bonus_received'), $total);
        } else {
            return $this->respError("Today No Task Left");
        }
    }

    function crVid($uid, $taskId)
    {
        $user = Users::find($uid);
        $this->checkTask($user, 'video');
        if ($user->video < env('video')) {
            
            if(TaskApi::where(['type' => 1, 'task_id' => $taskId, 'user_id' => $uid])->count()>0) {
                return $this->respError($this->getResponseMsg('bonus_already_claimed'));
            }
            
            $vid = Video::find($taskId);
            $coin = $vid->point;
            $user->video += +1;
            $total = $user->balance + $coin;
            $user->balance = $total;
            $this->insActivity('video', $coin, $total, $uid);
            $user->save();
            $vid->views += +1;
            $vid->save();
            $this->taskLog(1, $taskId, $uid);
            return $this->respOk($coin .' '.$this->getResponseMsg('bonus_received'), $total);
        } else {
            return $this->respError($this->getResponseMsg('today_no_task_left'));
        }
    }

    function crApp($uid, $taskId)
    {
        $user = Users::find($uid);
        $this->checkTask($user, 'app');
        if ($user->app < env('app')) {
            if ($this->countTask(5, $taskId, $uid, null) > 0) {
                return $this->respError("Bonus Already claimed");
            }
            $ofr = Apps::find($taskId);
            $coin = $ofr->points;
            $user->app += +1;
            $total = $user->balance + $coin;
            $user->balance = $total;
            $this->insActivity('app', $coin, $total, $uid);
            $user->save();
            $ofr->views += +1;
            $ofr->save();
            $this->taskLog(5, $taskId, $uid);
            return $this->respOk($coin .' '. $this->getResponseMsg('bonus_received'), $total);
        } else {
            return $this->respError($this->getResponseMsg('today_no_task_left'));
        }
    }
    
    function getRedeemCat(){
        $data=CacheManager::getRedeemCat();

       return response(['data' => $data, 'success' => 1]);

    }
    
    public function fetch_rewards_by_cat($id)
    {
        $data = DB::select('Select * from redeem where status=0 and cat=:cat order by points+0 ASC',['cat'=>$id]);
        if ($data) {
            return response(['data' => $data, 'success' => 1]);
        } else {
            return response(['message' => $this->getResponseMsg('data_not_found'), 'success' => 0]);
        }
    }
    
    function redeemNew($req)
    {
        $uid = $req['ex_id'];
        
        $rdm=Redeem::where('id',$req['id'])->first();
            
        if(!$rdm){
           return $this->respError('Oops this option currently not available'); 
        }
        
        $cat=RedeemCat::where('id',$req['x_'])->select('title')->first();
        
        if(!$cat){
           return $this->respError('Oops this option currently not available!'); 
        }
        
        $user = Users::find($uid);
        $currentcoin = $user->balance;
        
        if($user->status==1){
            return $this->respError($user->reason); 
        }

        if ($currentcoin >= $rdm->points) {
            $total = $currentcoin - $rdm->points;
            $user->balance = $total;
            $user->save();

            DB::table('recharge_request')
                ->insert([
                    'c_id'              =>       $req['id'],
                    'r_id'              =>       $req['x_'],
                    'mobile_no'         =>       $req['ex'],
                    'amount'            =>       $rdm->points,
                    'type'              =>       $cat->title.' | '.$rdm->title,
                    'status'            =>       'Pending',
                    'user_id'           =>       $uid,
                    'orginal_amount'    =>       $rdm->pointvalue,
                    'detail'            =>       $rdm->description,
                    'date'              =>       Carbon::now()
                ]);


            DB::table('transaction')->insert([
                'tran_type' => 'debit',
                'user_id' => $uid,
                'amount' => $rdm->points,
                'type' => 'Redeem',
                'remained_balance' => $total,
                'remarks' => "Coin Withdrawal",
                'inserted_at'=>Carbon::now()
            ]);
            return $this->respOk($this->getResponseMsg('redeem_successfully'), $total);
        } else {
            return $this->respError($this->getResponseMsg('not_enough_coin'));
        }
    }
    
    function get_refer_list($refid){
        $total=Users::where('from_refer','=',$refid)->count();
        $today=DB::table('customer')->where('from_refer','=',$refid)->whereDate('inserted_at',date('Y-m-d'))->count();
        if($total>0){
            return response(['total'=>$total,'today'=>$today,'data'=>DB::table('customer')->where('from_refer','=',$refid)->select('name','profile','inserted_at')->limit(50)->get(),'success'=>1]);
        }else{
             return response(['data'=>[],'success'=>0]);
        }
    }

    function history($uid)
    {
        $user = Users::find($uid);
        return $data = DB::select('SELECt amount,remarks,type,inserted_at,tran_type from transaction where user_id=:uid or user_id=:ogid order by id desc limit 30', ['uid' => $uid, 'ogid' => $user->cust_id]);
    }

    function Rewardhistory($uid)
    {
        $user = Users::find($uid);
        return $data = DB::select('select * from recharge_request where user_id =:uid or user_id=:ogid order by request_id desc limit 10', ['uid' => $uid, 'ogid' => $user->cust_id]);
    }
  
   	function leaderboard(){
      $data=DB::select("SELECT customer.name,customer.profile,customer.balance from customer ORDER BY balance+0 DESC Limit 30");
      return $data;
    }

    function respSpinOk($count, $limit,$interval)
    {
        return response(['count' => $count, 'limit' => $limit,'interval'=>$interval, 'code' => 201]);
    }

    function taskLog($type, $taskid, $uid)
    {
        TaskApi::insert(['type' => $type, 'task_id' => $taskid, 'user_id' => $uid]);
    }

    function countTask($type, $taskid, $uid, $date)
    {
        if ($date == null) {
            return TaskApi::where(['type' => $type, 'task_id' => $taskid, 'user_id' => $uid])->count();
        } else {
            return TaskApi::where(['type' => $type, 'task_id' => $taskid, 'user_id' => $uid])->whereDate('created_at', Carbon::now())->count();
        }
    }
    

    public function configv2()
    {
        CacheManager::clearVpn();
        $data = CacheManager::getConfig();
        $vpn = CacheManager::getVpn()->isVpn;
        $ads = CacheManager::getAds();
        
        if ($data) {
            return response([
                'data' => $data,
                'vpn'=>$vpn,
                'ads'=>$ads,
                'success' => 1
            ]);
        } else {
            return response(['data' => $this->getResponseMsg('data_not_found'), 'success' => 0]);
        }
    }

    public function config()
    {
        $data = DB::table('setting')->where('id', 1)->select('adConfig',
        'homepage',
        'nativeId',
        'nativeCount',
        'nativeType',
        'up_btn',
        'up_version',
        'up_status',
        'up_mode',
        'up_link',
        'up_msg',
        'share_msg',
        'interstital_type',
        'interstital_ID',
        'interstital_count',
        'interstital',
        'bannerid',
        'banner_type',
        'app_email',
        'app_author',
        'app_description',
        'ui_style'
        )->get();
        
        $vpn = DB::table('app_setting')->where('id', 1)->select('isVpn')->get();
        
        if ($data) {
            return response(['data' => $data,'vpn'=>$vpn[0]->isVpn, 'success' => 1]);
        } else {
            return response(['data' => $this->getResponseMsg('data_not_found'), 'success' => 0]);
        }
    }

    function get_spin(){
        $spin = CacheManager::getSpin();
        return response(['spin'=>$spin,'success'=>1]);
    }

    public function offers()
    {
        $lang=(request()->header('lang')==null || request()->header('lang')=='') ? 'en' : request()->header('lang');          
        $offers=CacheManager::getOffersByLang($lang);
        if ($offers) {
            return response(['data' => $offers, 'code' => 201]);
        } else {
            return response(['data' => $this->getResponseMsg('data_not_found'), 'code' => 404]);
        }
    }

    public function games()
    {
        $data = CacheManager::getGames();
        if ($data) {
            return response(['data' => $data, 'success' => 1]);
        } else {
            return response(['message' => $this->getResponseMsg('data_not_found'), 'success' => 0]);
        }
    }

    public function sldiebanner()
    {
        $data = CacheManager::getSliderBanner();
        if ($data) {
            return response(['data' => $data, 'success' => 1]);
        } else {
            return response(['data' => $this->getResponseMsg('data_not_found'), 'success' => 0]);
        }
    }

    public function fetch_rewards()
    {
        $data = CacheManager::getRedeem();
        if ($data) {
            return response(['data' => $data, 'success' => 1]);
        } else {
            return response(['message' => $this->getResponseMsg('data_not_found'), 'success' => 0]);
        }
    }

    public function removeUser($uid)
    {
        // Users::where('uid', $uid)->delete();
        // DB::table('transaction')->where('user_id', $uid)->delete();
        // DB::table('task')->where('user_id', $uid)->delete();

        // return $this->respOk("Data Delete Successfully");
    }
    
    function submit_hotoffer(Request $req){
        
            $srv = DB::table('hot_offer')->where('id', $req->id)->get();
  
            $cn = DB::table('hotoffer_data')->where(['task_id' => $req->id, 'user_id' => $req->uid])->count();

            if ($cn > 0) {
                return response()->json(['msg' => $this->getResponseMsg('offer_Already_Submited'), 'code' => 201]);
            }
            
            if($srv[0]->task_limit>0){
                if ($srv[0]->views >= $srv[0]->task_limit) {
                    return response()->json(['msg' => $this->getResponseMsg('Oops_you_are_late_offer_limit_has_been_completed'), 'code' => 202]);
                }
            }
            
            $user=DB::table('customer')->where('uid',$req->uid)->select('name')->first();
            
            if($req->newimage){
                $image = $req->newimage;
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
                $filename = preg_replace("/\s+/", '-', $filename);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = uniqid() . '_' . time() . '.' . $extension;
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(300, 500);
                $image_resize->save('images/uploaded/' . $fileNameToStore);
    
                DB::table('hotoffer_data')->insert([
                    'message' => $req->link,
                    'task_id' => $req->id,
                    'status' => 0,
                    'image' => $fileNameToStore,
                    'user_id' => $req->uid,
                    'username' => $user->name,
                    'title' => $srv[0]->title,
                ]);
            }else{
                
            }


            DB::table('hot_offer')->where('id', $req->id)->update(['views' => ($srv[0]->views + 1)]);

            if ($srv[0]->task_limit > 0) {
                if (($srv[0]->views + 1) >= $srv[0]->task_limit) {
                    DB::table('hot_offer')->where('id', $req->id)->update(['status' => 2]);
                }
            }

            return response()->json(['msg' => $this->getResponseMsg('Offer_Submit_Successfully_Bonus_will_be_receive_after_verification'), 'code' => 201]);
    }
}
