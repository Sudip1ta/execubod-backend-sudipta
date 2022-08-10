<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Programme;
use DB;
use Validator;

class PackagesController extends Controller
{
    public function index()
    {
        $get_packages = DB::table('workout_program')
                        ->join('category','category.id','=','workout_program.category_id')
                        ->select('category.category_name','workout_program.*')
                        ->orderBy('workout_program.created_at','ASC')
                        ->get()
                        ->toArray();

       return view('admin.packages.packages_list',compact('get_packages'));
    }

    public function create()
    {
        $goals = DB::table('goals')->where('status',0)->orderBy('goal_name','ASC')->get();
        $category = Category::where('status',0)->orderBy('category_name','ASC')->get();
        return view('admin.packages.package_create',compact('category','goals'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(),[
            'title'=>'required|string|max:255',
            'category' => 'required|numeric',
            'goal' => 'required|numeric',
            'level' => 'required|string',
            'total_week' => 'required|numeric',
            'avg_day_per_week' => 'required|numeric',
            'avg_workout_time' => 'required|numeric',
            'duration'=>'required|numeric',
            'cost'=>'required',
            'excercise_name.*'=>'required|numeric',
            'time.*' => 'required|numeric',
        ]);
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }


        $goals = DB::table('goals')->where('id',$request->goal)->first();
       
      
        $create = Programme::create([
            'category_id' => $request->category,
            'goal_id' => $request->goal,
            'title' => $request->title,
            'level' => $request->level,
            'weeks'=> $request->total_week,
            'avg_days' => $request->avg_day_per_week,
            'avg_workout_time_per_day' => $request->avg_workout_time,
            'total_duration' =>  $request->duration,
            'main_goal'=>$goals->goal_name,
            'free_days' =>$request->free_days,
            'cost' => $request->cost,
            'description' => $request->note
        ]);

        if($create){

            if(isset($input['excercise_name']) && !empty($input['excercise_name'])){

                for($i = 0; $i <= count($input['excercise_name']); $i++){

                    if(!empty($input['excercise_name'][$i])){

                        $get_excercise = DB::table('excercise')->where('id',$input['excercise_name'][$i])->first();

                        DB::table('package_excercise_details')->insert([
                            'package_id' => $create->id,
                            'excercise_id' => $input['excercise_name'][$i],
                            'excercise_name' => $get_excercise->excercise_name,
                            'time' => $input['time'][$i],
                        ]);
                    }
                }
            }

            return redirect('admin/all-packages')->with('success','Package Successfully Created');
                
        }else{
            return redirect()->back()->withErrors(['Something Wents Wrong']);
        }

        
    }

    public function get_excercise(Request $request)
    {
        $get_excercise = DB::table('excercise')->where('category_id',$request->cat_id)->where('goal_id',$request->goal_id)->where('status',0)->orderBy('position','ASC')->get()->toArray();

        if(!empty($get_excercise)){
            return response()->json(['status'=>1,'data'=>$get_excercise]);
        }else{
            return response()->json(['status'=>0]);
        }
    }


    public function status_update(Request $request)
    {
        $pack_status =DB::table('workout_program')->where('id',$request->id)->update([
            'status' => $request->update
        ]);

        if($pack_status){
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }


    public function delete(Request $request)
    {
        $pack_delete =DB::table('workout_program')->where('id',$request->id)->delete();

        if($pack_delete){
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }

    public function get_pack_info(Request $request, $id)
    {
        $get_package = Programme::join('category','category.id','=','workout_program.category_id')->where('workout_program.id',$id)->select('workout_program.*','category_name')->first();

        $get_excercise = DB::table('package_excercise_details')->where('package_id',$id)->get()->toArray();
        
        return view('admin.packages.package_details',compact('get_package','get_excercise'));
    }   
}
