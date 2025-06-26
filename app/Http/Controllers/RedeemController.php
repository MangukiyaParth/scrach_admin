<?php

namespace App\Http\Controllers;

use App\Models\Redeem;
use App\Models\RedeemCat;
use App\Services\CacheManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RedeemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('redeem.redeem');
    }
    
    function catIndex(){
        return view('redeem.cat');
    }  
    
    function createRedeem(){
        return view('redeem.create-redeem',['cat'=>RedeemCat::all()]);
    }

    public function List(){
        $data=Redeem::query()->orderBy('redeem.id','DESC');

        return DataTables::eloquent($data)
         ->addIndexColumn()
         ->addColumn('image',function($data){
             return '<img src="'.url('images/'.$data->image).'" alt="An image" height="100px">';
         })
         ->addColumn('cat',function($data){
             if($data->cat==null){
                return '<span class="badge badge-info">Not Added in Category</span>';  
             }else{
                $cat=RedeemCat::where('id',$data->cat)->select('title')->first();
                if($cat){
                    return '<span class="badge badge-success">'.$cat->title.'</span>'; 
                }else{
                    return '<span class="badge badge-danger">Category Deleted</span>'; 
                }
             }
         })
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                 <a href="'.url('/payment-options/edit/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>    
                 <button type="button" class="btn btn-danger remove-redeem" data-id="'.$data->id.'"  ><i class="ik ik-trash"></i>Delete</button>
              </div>';    
         })
         ->rawColumns(['DT_RowIndex','image','cat','action'])      
         ->toJson();
    }
    
    public function catList(){
        $data=RedeemCat::query();

        return DataTables::eloquent($data)
         ->addIndexColumn()
         ->addColumn('image',function($data){
             return '<img src="'.url('images/'.$data->image).'" alt="An image" height="100px">';
         })
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                 <button type="button" class="btn btn-success edit-cat" data-id="'.$data->id.'"  ><i class="ik ik-edit"></i>Edit</button>
                 <button type="button" class="btn btn-danger remove-cat" data-id="'.$data->id.'"  ><i class="ik ik-trash"></i>Delete</button>
              </div>';    
         })
         ->rawColumns(['DT_RowIndex','image','action'])      
         ->toJson();
    }
    
  
    public function store(Request $request)
    {
        
        if(auth()->user()->role_create=='false'){
            return redirect('/payment-options')->with('error',env('permission_msg'));
        }
        
        $validate = Validator::make($request->all(), [
            'icon' => "required|mimes:jpeg,png,jpg",
        ],[
            'icon'=>'Please Select valid Image Supported Jpeg/Png'
            ]);
        if ($validate->fails()) {
            return redirect('/payment-options')->with('error', $validate->errors()->first());
        }
        
        $fileNameToStore=Fun::StoreImage('images/','icon',null,null,$request,null);
        if ($fileNameToStore==null) {
            return redirect('/payment-options')->with('error','Please Select valid Image Supported Jpeg/Png');
        }
    
        $redeem= new Redeem;
        $redeem->title=$request->name;
        $redeem->image=$fileNameToStore;
        $redeem->points=$request->coin;
        $redeem->description=$request->detail;
        $redeem->pointvalue=$request->currency;
        $redeem->cat=$request->cat;
        $redeem->hint=$request->hint;
        $redeem->input_type=$request->input_type;
        $res=$redeem->save();
        CacheManager::clearRedeem();
        CacheManager::getRedeemCat();
        if($res){
            return redirect('/payment-options')->with('success', 'Task Created Successfully!');
        }else{
            return redirect('/payment-options')->with('error', 'Technical Error!');
        }
      }
      
  
    public function catStore(Request $request)
    {
        
        if(auth()->user()->role_create=='false'){
            return redirect('/payment-options/category')->with('error',env('permission_msg'));
        }

        $fileNameToStore=Fun::StoreImage('images/','icon',null,null,$request,null);
        if ($fileNameToStore==null) {
            return redirect('/payment-options/category')->with('error','Please Select valid Image Supported Jpeg/Png');
        }

        $cat= new RedeemCat;
        $cat->title=$request->title;
        $cat->image=$fileNameToStore;
        $cat->item_order=$request->item_order;
        $res=$cat->save();
        CacheManager::clearRedeem();
        CacheManager::getRedeemCat();
        if($res){
            return redirect('/payment-options/category')->with('success', 'Category Created Successfully!');
        }else{
            return redirect('/payment-options/category')->with('error', 'Technical Error!');
        }   
      }

    public function edit(Redeem $id)
    {
        if(auth()->user()->role_edit=='false'){
            return redirect('/payment-options')->with('error',env('permission_msg'));
        }
        return view('redeem.edit-redeem',['redeem'=>$id,'cat'=>RedeemCat::all()]);
    }
    
    public function catEdit(RedeemCat $id)
    {
        if(auth()->user()->role_edit=='false'){
            return redirect('/payment-options')->with('error',env('permission_msg'));
        }
        return $id;
    }

    public function update(Request $request, Redeem $redeem)
    {
        
        $redeem= Redeem::find($request->id);
        
        if(isset($request->icon)){
            $fileNameToStore=Fun::StoreImage('images/','icon',null,null,$request,$request->oldimage);
            if ($fileNameToStore==null) {
                return redirect('/payment-options/category')->with('error','Please Select valid Image Supported Jpeg/Png');
            }
            
             $redeem->image=$fileNameToStore;
        }
        
        
        $redeem->title=$request->name;
       
        $redeem->points=$request->coin;
        $redeem->cat=$request->cat;
        $redeem->hint=$request->hint;
        $redeem->input_type=$request->input_type;
        $redeem->description=$request->detail;
        $redeem->pointvalue=$request->currency;
        $res=$redeem->save();
        CacheManager::clearRedeem();
        CacheManager::clearRedeemCat();
            if($res){
                return redirect('/payment-options')->with('success', 'Update Successfully!');
            }else{
                return redirect('/payment-options')->with('error', 'Technical Error!');
            }  
 
    }
    
    
    public function catUpdate(Request $request, RedeemCat $redeem)
    {
        $cat= RedeemCat::find($request->id);
        
        if(isset($request->icon))
        {
            $fileNameToStore=Fun::StoreImage('images/','icon',null,null,$request,$cat->image);
            if ($fileNameToStore==null) {
                return redirect('/payment-options/category')->with('error','Please Select valid Image Supported Jpeg/Png');
            }else{
                 $cat->image=$fileNameToStore;
            }
        
        }
        
        $cat->title=$request->title;
        $cat->item_order=$request->item_order;
        $cat->status=$request->status;
        $res=$cat->save();
        CacheManager::clearRedeem();
        CacheManager::clearRedeemCat();
        if($res){
            return redirect('/payment-options/category')->with('success', 'Category Update Successfully!');
        }else{
            return redirect('/payment-options/category')->with('error', 'Technical Error!');
        }  
 
    }


    public function destroy($id)
    {
        if(auth()->user()->role_delete=='false'){
            return env('permission_msg');
        }
        CacheManager::clearRedeem();
        CacheManager::clearRedeemCat();
        $r=Redeem::find($id);
        Fun::removeImage('images/',$r->image);
        $r->delete();
        return 1;
    }
    
    public function catDestroy($id)
    {
        if(auth()->user()->role_delete=='false'){
            return env('permission_msg');
        }
        
        $image=Redeem::where('cat',$id)->pluck('image');
        
        for($i=0; $i<count($image); $i++){
            Fun::removeImage('images/',$image[$i]);
        }
        CacheManager::clearRedeem();
        CacheManager::clearRedeemCat();
        Redeem::where('cat',$id)->delete();
        $r=RedeemCat::find($id);
        Fun::removeImage('images/',$r->image);
        $r->delete();
        return 1;
    }
}
