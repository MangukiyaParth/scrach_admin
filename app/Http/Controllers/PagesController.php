<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.pages');
    }
    
     public function List(){
        $data=Pages::get();

        return DataTables::of($data)
         ->addIndexColumn()
         ->addColumn('url',function($data){
             return '<a href='.url('/page/'.$data->slug).' target="_blank">'.url('/page/'.$data->slug).'</a>';
         })
        ->addColumn('visible', function($data){
             $status = $data->status;
                    if($status ==0){
                        return '<span class="badge badge-success ">Yes</span>';
                    }else{
                        return '<span class="badge badge-danger" >No</span>';  
                    }
             })     
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                 <button type="button" class="btn btn-success edit-page" data-id="'.$data->id.'"  ><i class="ik ik-edit"></i>Edit</button>
                <button type="button" class="btn btn-danger remove-page" data-id="'.$data->id.'"  ><i class="ik ik-trash"></i>Delete</button>
              </div>';    
         })
         ->rawColumns(['DT_RowIndex','url','visible','action'])      
         ->make(true);    
    }

   
    public function store(Request $request)
    {
        if(auth()->user()->role_create=='false'){
            return redirect('/setting/pages')->with('error',env('permission_msg'));
        }
 
        $page= new Pages;
        $page->title=$request->title;
        $page->slug=$request->slug;
        $page->text=$request->detail;
        $page->visible=$request->visible;
        $res=$page->save();
            if($res){
                return redirect('/setting/pages')->with('success', 'Created Successfully!');
            }else{
                return redirect('/setting/pages')->with('error', 'Technical Error!');
            }
 
    }


    public function edit(Pages $id)
    {
       return $id;
    }

   
    public function update(Request $request, Pages $page)
    {
        if(auth()->user()->role_edit=='false'){
            return redirect('/setting/pages')->with('error',env('permission_msg'));
        }
 
        
        $page= Pages::find($request->id);
        $page->title=$request->title;
        $page->slug=$request->slug;
        $page->text=$request->detail;
        $page->visible=$request->visible;
        $res=$page->save();
            if($res){
                return redirect('/setting/pages')->with('success', 'Update Successfully!');
            }else{
                return redirect('/setting/pages')->with('error', 'Technical Error!');
            }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->role_delete=='false'){
            return env('permission_msg');
        }
        
       Pages::find($id)->delete();
       return 1;
    }
    
    public function action(Request $req)
    {
        if(auth()->user()->role_delete=='false'){
            return env('permission_msg');
        }
        
        $ids = $req->id;
        if($req->status=='enable'){
           $update =Pages::whereIn('id',explode(",",$ids))->update(array('status' =>0)); 
            if($update){
                return 1;
            }else{
                return "not updated";
            }
        }
        else if($req->status=='disable'){
            $update =Pages::whereIn('id',explode(",",$ids))->update(array('status' =>2)); 
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }else if($req->status=='delete'){
            $update =Pages::whereIn('id',explode(",",$ids))->delete();
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
    }
}
