<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppInfo;
use Validator;

class AppIntroManagementController extends Controller
{
    public function app_intro_view()
    {
        $info = AppInfo::orderBy('created_at','DESC')->get();
        return view("admin.app_intro_view",compact('info'));
    }


    public function app_intro_update(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'shrt_des' => 'required|max:200',
            'des' => 'required',
            'intro_id' => 'required|numeric',

            ],
            [
                'shrt_des.required' => "Short Description is Required",
                'shrt_des.max' => "Short Description Max 200 character are allowed",
                'des.required' => "Full Description is Required",
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 2,
                'message' => 'Error Occured',
                'errors' => $validator->errors()
            ]);
        }

        $intro_info = AppInfo::find($request->intro_id);

        $intro_info->short_description = $request->shrt_des;
        $intro_info->description = $request->des;

        if($intro_info->save()){
            return response()->json(['status' => 1 , 'data' => $intro_info]);
        }else{
            return response()->json(['status' => 0]);
        }

    }

    public function app_intro_delete(Request $request)
    {
        $intro_delete = AppInfo::where('id',$request->id)->delete();

        if($intro_delete){
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }

    public function add_intro()
    {
        return view("admin.app_intro_create");
    }

    public function intro_store(Request $request)
    {
        $request->validate([
            'shrt_des' =>'required|max:200',
            'full_des' => 'required'
        ],
        [
            'shrt_des.required' => "Short Description is Required",
            'shrt_des.max' => "Short Description Max 200 character are allowed",
            'full_des.required' => "Full Description is Required",
        ]
        );

        
        $create = AppInfo::create([
            'short_description' => $request->shrt_des,
            'description'=> $request->full_des,
        ]);

        if($create){
            return redirect('admin/app-intro')->with('success','New Intro has been created');
        }else{
            return redirect()->back()->with('error','Some error occured');
        }
    }

    public function intro_status_update(Request $request)
    {   
        $update = AppInfo::where('id',$request->id)->update([
            'status' => $request->update
        ]);

        if($update){
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }
}
