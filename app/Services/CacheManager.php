<?php

namespace App\Services;

use App\Models\Offerwall;
use App\Models\RedeemCat;
use App\Models\Social;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CacheManager
{
    private const KEY_CONFIG = 'app:config';
    private const KEY_VPN    = 'app:vpn';
    private const KEY_ADS    = 'app:ads';
    private const KEY_SPIN   = 'app:spin';
    private const KEY_SPIN_CONFIG   = 'app:spin_config';
    private const KEY_GAME   = 'app:game';
    private const KEY_SOCIAL   = 'app:social';
    private const KEY_SLIDER_BANNER   = 'app:banner';
    private const KEY_REDEEM   = 'app:redeem';
    private const KEY_OFFERWALL   = 'app:offerwall';
    private const KEY_REDEEM_CAT   = 'app:redeem_cat';

    public static function getConfig(){
        return Cache::remember(
            self::KEY_CONFIG,
            now()->addDay(2),
            function () {
                return DB::table('setting')->where('id', 1)->select(
                        'app_email','interstital_count','share_msg','up_msg','up_link','up_mode',
                        'up_status','up_version','up_btn','nativeCount','homepage','ui_style','offerwall_style',
                        'offerwall_layout','survey_style','survey_layout','active_ad','banner',
                        'banner_id','inter','inter_id','native','native_id','ad_not_load_credit'
                        )->get();
            }
        );
    }

    public static function getOfferwall(){
        return Cache::remember(
            self::KEY_OFFERWALL,
            now()->addDay(2),
            function () {
                return Offerwall::where(['status'=>0])->select('id','title','description','offerwall_url',
                    'thumb','offerwall_slug','offer_type','card_color','text_color','u_tag','advid_tag','uid_type','browser_type')
                    ->orderBy('item_order','ASC')->get();
            }
        );
        
    }

    public static function getGames(){
        return Cache::remember(
            self::KEY_GAME,
            now()->addDay(2),
            function () {
                return DB::table('games')->get();
            }
        );
    }

    public static function getRedeem(){
        return Cache::remember(
            self::KEY_REDEEM,
            now()->addDay(2),
            function () {
                return DB::table('redeem')->where('status',0)->get();
            }
        );
    }
    public static function getRedeemCat(){
        return Cache::remember(
            self::KEY_REDEEM,
            now()->addDay(2),
            function () {
                return RedeemCat::where('status',0)->orderBy('item_order','ASC')->get();
            }
        );
    }

    public static function getSliderBanner(){
        return Cache::remember(
            self::KEY_SLIDER_BANNER,
            now()->addDay(2),
            function () {
                return DB::table('home_banner')->where('status',0)->get();
            }
        );
    }

    public static function getOffersByLang(string $lang): array
    {
        $cacheKey = "offers_{$lang}";
        
        return Cache::remember($cacheKey, now()->addDay(2), function () use ($lang) {
            switch ($lang) {
                case 'hi':
                    $column = 'offer_title_hi';
                    break;
                case 'tr':
                    $column = 'offer_title_tr';
                    break;
                case 'es':
                    $column = 'offer_title_es';
                    break;
                case 'ar':
                    $column = 'offer_title_ar';
                    break;
                default:
                    $column = 'offer_title';
            }

            return DB::table('offers')
                ->select("{$column} AS offer_title", 'offer_icon', 'type')
                ->where('status', 0)
                ->orderBy('item_order', 'asc')
                ->get()
                ->toArray();
        });
    }


    public static function getAds(){
        return Cache::remember(
            self::KEY_ADS,
            now()->addDay(2),
            function () {
                return DB::table('ad_network')->where('status', 1)->select('ad_id','slug','app_id','inter_id','reward_id')->get();
            }
        );
    }

    public static function getVpn(){
        return Cache::remember(
            self::KEY_VPN,
            now()->addDay(2),
            function () {
                return DB::table('app_setting')
                     ->where('id', 1)
                     ->select('isVpn')
                     ->first();
            }
        );
    }

    public static function getSpin(){
        return Cache::remember(
            self::KEY_SPIN,
            now()->addDay(2),
            function () {
                return DB::table('wheel_points')->get();
            }
        );
    }

    public static function getSpinConfig(){
        return Cache::remember(
            self::KEY_SPIN_CONFIG,
            now()->addDay(2),
            function () {
                return DB::table('wheel_points')->select('position_1','position_2','position_3','position_4','position_5','position_6','position_7','position_8')->first();
            }
        );
    }

    public static function clearVpn(){
        Cache::forget(self::KEY_VPN);
    }
    public static function clearSpin(){
        Cache::forget(self::KEY_SPIN);
        Cache::forget(self::KEY_SPIN_CONFIG);
    }

    public static function clearOfferwall(){
        Cache::forget(self::KEY_OFFERWALL);
    }

    public static function clearGame(){
        Cache::forget(self::KEY_GAME);
    }

    public static function clearConfig(){
        Cache::forget(self::KEY_CONFIG);
    }

    public static function clearRedeem(){
        Cache::forget(self::KEY_REDEEM);
    }

    public static function clearRedeemCat(){
        Cache::forget(self::KEY_REDEEM_CAT);
    }

    public static function clearSlider(){
        Cache::forget(self::KEY_SLIDER_BANNER);
    }

    public static function clearSocial(){
        Cache::forget(self::KEY_SOCIAL);
    }

    public static function clearOffersCache(): void
    {
        foreach (['en','hi','tr','es','ar'] as $lang) {
            Cache::forget("offers_{$lang}");
        }
    }
}