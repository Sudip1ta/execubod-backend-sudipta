<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\AppInfo;
use App\Models\Category;
use App\Models\Programme;
use App\Models\Goal;
use App\Models\Excercise;
use Validator;
use DB;

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
        $all_category = Category::where('status',0)->select('id','category_name','note')->orderBy('category_name','ASC')->get();

        return response()->json([
            'status'=>true,
            'data' => $all_category
        ]);
    }


    public function fetch_programs_by_category(Request $request)
    {
        $input = $request->all();

        if(isset($input['category_id'])){

            $goal_id = isset($input['goal_id']) ? $input['goal_id'] : 0;

            $goal_opt = isset($input['goal_id']) ? '=' : '!=';

            $programme_list = Programme::where('category_id',$input['category_id'])
                            ->where('goal_id',$goal_opt,$goal_id)
                            ->where('status',0)
                            ->select('category_id','goal_id','title','main_goal','description','level','weeks','avg_days','avg_workout_time_per_day','total_duration','free_days','cost','food_perefence','status')
                            ->orderBy('title','ASC')
                            ->get(); 

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

            $programme_info = Programme::join('category','category.id','=','workout_program.category_id')->select('workout_program.id','category_id','category_name','goal_id','title','main_goal','description','level','weeks','avg_days','avg_workout_time_per_day','total_duration','free_days','cost','food_perefence')->find($input['package_id']);

            if(isset($programme_info->id)){

                $get_excercise = DB::table('package_excercise_details')
                                ->select('id','package_id','excercise_id','excercise_name','time')
                                ->where('package_id',$programme_info->id)
                                ->get()
                                ->toArray();

                $programme_info['excercise_info'] = $get_excercise;

                return response()->json([
                    'status'=>true,
                    'data' =>  $programme_info,
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

    public function get_goals(Request $request)
    {
        $goals = Goal::select('id','goal_name','note','icon')->where('status',0)->orderBy('goal_name','ASC')->get();

        return response()->json([
            'status'=>true,
            'data' => $goals
        ]);
    }


    public function get_excercise(Request $request)
    {
        $input = $request->all();

        if(!empty($input['category_id'])){

            if(!empty($input['goal_id'])){

                $excercise = Excercise::join('category','category.id','=','excercise.category_id')
                            ->join('goals','goals.id','=','excercise.goal_id')
                            ->select('excercise.id','category_id','category_name','goal_id','goal_name','excercise_name','excercise.position','excercise.note')    
                            ->where('excercise.status',0)
                            ->where('category_id',$input['category_id'])
                            ->where('goal_id',$input['goal_id'])
                            ->get()
                            ->toArray();

                if(!empty($excercise)){
                    return response()->json([
                        'status'=>true,
                        'data' => $excercise
                    ]);
                }else{
                    return response()->json([
                        'status'=>false,
                        'message' => "No excercise were found regarding this category"
                    ]);
                }

            }else{

               return response()->json([
                    'status'=>false,
                    'message' => "Goal id is missing"
                ]);
            }
        }else{
            return response()->json([
                'status'=>false,
                'message' => "Category id is missing"
            ]);
        }
        
    }

    public function category_of_user(Request $request)
    {
        $input = $request->all();
        
        $rules = [
            'category_id' => 'required',
            'user_id' => 'required',
            'user_height' => 'required',
            'user_weight' => 'required',
            'user_experience' => 'required'
        ];

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Faild',
                'errors' => $validator->errors()
            ]);
        }
        //$cat_encoded_id = "";
        $arr= $request->category_id;

        $string=implode(",",$arr);

        //dd($string);
        //$cat_encoded_id = json_encode($arr);

        //dd($cat_encoded_id);

        $add_categories = DB::table('users_more_info')->insert([
            'user_id' => $request->user_id,
            'category_id' => $string,
            'user_height' => $request->user_height,
            'user_weight' => $request->user_weight,
            'user_experience' => $request->user_experience
        ]);

       
        return response()->json([
            'success' => true,
            'message' => 'Successfully Add User Information ',
        ], 200);

    }

    public function category_list(Request $request)
    {
        $cat_list = DB::table('category')->select('id','category_name')->get()->toArray();

        return response()->json([
            'success' => true,
            'data' =>$cat_list
        ], 200);
    }


}
