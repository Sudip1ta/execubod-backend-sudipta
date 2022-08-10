<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\AppInfo;
use App\Models\Category;
use App\Models\Programme;


class AppController extends Controller
{
    public function get_app_intro(Request $request)
    {
        $intro = AppInfo::select('short_description','description','image_id')->where('status',0)->first();

        return response()->json([
            'status'=>true,
            'data' => $intro
        ]);
    }

    public function get_category()
    {
        $all_category = Category::select('id','category_name','note')->where('status',0)->orderBy('category_name','ASC')->get();

        return response()->json([
            'status'=>true,
            'data' => $all_category
        ]);
    }


    public function fetch_programs_by_category(Request $request)
    {
        $input = $request->all();

        if(isset($input['category_id'])){

            $programme_list = Programme::select('id','category_id','title','days','main_goal','level')->where('category_id',$input['category_id'])->where('status',0)->orderBy('title')->get();

            $programme_count = count($programme_list);

            if($programme_count > 0){

                return response()->json([
                    'status'=>true,
                    'data' => $programme_list
                ]);

            }else{

                return response()->json([
                    'status'=>false,
                    'message' => "No Records Found"
                ]);
            }
        }else{
            return response()->json([
                'status'=>false,
                'message' => "Category id is missing"
            ]);
        }     
    }


    public function programme_details(Request $request)
    {
        $input = $request->all();

        if(isset($input['package_id'])){

            $programme_info = Programme::find($input['package_id']);

            if(isset($programme_info->id)){
                return response()->json([
                    'status'=>true,
                    'data' =>  $programme_info
                ]);
            }else{
                return response()->json([
                    'status'=>false,
                    'message' => "Programme Details Not Found"
                ]);
            }
            
        }else{
            return response()->json([
                'status'=>false,
                'message' => "Programme id is missing"
            ]);
        }
        
    }
}
