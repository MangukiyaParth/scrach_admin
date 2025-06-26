<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Image;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Facades\Validator;

class Fun extends Controller
{
    public static function StoreImage($location,$filename,$width,$height,$req,$removeOldFile){
        
        $validate = Validator::make($req->all(), [
            $filename => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ],[
            $filename=>'Please Select valid Image Supported Jpeg/Png'
            ]);
        if ($validate->fails()) {
            return null;
        }

        $image = $req->$filename;
        $filenameWithExt = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $fileNameToStore = uniqid() .'.' . $extension;
        $image_resize = Image::make($image->getRealPath());
        if($width!=null || $height!=null){
           $image_resize->resize($width,$height);
        }
        
        $save = $image_resize->save($location . $fileNameToStore);
        
        if($removeOldFile!=null){
            Fun::removeImage('/'.$location,$removeOldFile);
        }
        
        if($save){
            return $fileNameToStore;
        }else{
            return null;
        }
    }
    
    public static function removeImage($location,$filename){
        $image_path = $location.$filename;
        if($location!=null && $filename!=null){
            try{
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }catch(\Exception $e){}
        }
    }
}    
    
   