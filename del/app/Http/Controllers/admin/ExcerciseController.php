<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Goal;
use App\Models\Excercise;
use Validator;

class ExcerciseController extends Controller
{
    public function index()
    {
        $category = Category::where('status',0)->orderBy('position','ASC')->get();
        $goal = Goal::where('status',0)->orderBy('goal_name','ASC')->get();

        $excercise_list = Excercise::join('category','category.id','=','excercise.category_id')
                        ->join('goals','goals.id','=','excercise.goal_id')
                        ->select('category_name','goal_name','excercise.*')
                        ->orderBy('category_name','ASC')
                        ->get();

        return view("admin.excercise.excercise_view",compact('excercise_list','category','goal'));
    }


    public function create()
    {   
        $category = Category::where('status',0)->orderBy('position','ASC')->get();
        $goal = Goal::where('status',0)->orderBy('goal_name','ASC')->get();

        return view("admin.excercise.excercise_add",compact('category','goal'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'category' => 'required|numeric',
            'goal' => 'required|numeric',
            'excercise_name'  => 'required|string', 
            'position' => 'required|numeric',
        ]);

        $excercise = Excercise::create([
            'category_id' => $request->category,
            'goal_id' => $request->goal,
            'excercise_name' => $request->excercise_name,
            'position' => $request->position,
            'note' => $request->note,
        ]);

        if($excercise){
            return redirect('admin/excercise')->with('success','New Excercise added successfully');
        }else{
            return redirect()->back()->with('error','New Excercise added successfully');
        }
       
    }


    public function update(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'excercise_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'goal_id' => 'required|numeric',
            'excercise_name' => 'required|string',
            'position' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 2,
                'message' => 'Error Occured',
                'errors' => $validator->errors()
            ]);
        }

        $excercise = Excercise::find($request->excercise_id);

        $excercise->category_id = $request->category_id;
        $excercise->goal_id = $request->goal_id;
        $excercise->excercise_name = $request->excercise_name;
        $excercise->position = $request->position;
        $excercise->note = $request->note;

        if($excercise->save()){
            return response()->json(['status' => 1 , 'data' => $excercise]);
        }else{
            return response()->json(['status' => 0]);
        }

    }


    public function status_update(Request $request)
    {
        $excercise_status = Excercise::where('id',$request->id)->update([
            'status' => $request->update
        ]);

        if($excercise_status){
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }


    public function delete(Request $request)
    {
        $excercise_delete = Excercise::where('id',$request->id)->delete();

        if($excercise_delete){
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }
}
