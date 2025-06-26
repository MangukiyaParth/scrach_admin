<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Base64;
use Illuminate\Support\Str;
use DB;
use App\Models\Pages;

class HomeController extends Controller
{
    
    public function home()
    {
        $pages=DB::table('pages')->where('visible',0)->get();
       
        return view('home',['pages'=>$pages]);
    }
    
    function pages($slug){
        $page=Pages::where('slug',$slug)->first();
        return view('viewpage',['data'=>$page]);
    }

    public function clearCache()
    {
        \Artisan::call('view:clear');
        \Artisan::call('cache:clear');
        \Artisan::call('route:clear');
        \Artisan::call('config:clear');
        return view('clear-cache');
    }
    
    public function defaultHome(){
    }
    
    public function call()
    {
      $this->updateData('API_KEY',Str::random(30));
        
      return redirect('admin-profile')->with('success','Api Key Changed success');  
    }
    
    public static function updateData($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
            ));
        }
        
        // \Artisan::call('config:cache');
        \Artisan::call('config:clear');
    }
    
}
