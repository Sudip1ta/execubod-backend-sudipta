<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goal;
use DB;
use Validator;

class GoalController extends Controller
{
    public function index()
    {
        $get_goals = Goal::orderBy('goal_name','ASC')->get();

        return view("admin.goal.goals_view",compact('get_goals'));
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'goal_id' => 'required|numeric',
            'goal_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 2,
                'message' => 'Error Occured',
                'errors' => $validator->errors()
            ]);
        }
       
        $goal = Goal::find($request->goal_id);

        $goal->goal_name = $request->goal_name;
        $goal->note = $request->note;
    
        if($goal->save()){
            return response()->json(['status' => 1 , 'data' => $goal]);
        }else{
            return response()->json(['status' => 0]);
        }
    }


    public function status_update(Request $request)
    {
        $goal_status = Goal::where('id',$request->id)->update([
            'status' => $request->update
        ]);

        if($goal_status){
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }


    public function delete(Request $request)
    {
        $goal_delete = Goal::where('id',$request->id)->delete();

        if($goal_delete){
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }

    public function goal_add()
    {
        return view('admin.goal.goal_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'goal_name' => 'required|string|max:255',
        ]);
        
        $goal_add = Goal::create([
            'goal_name' => $request->goal_name,
            'note' =>  $request->note
        ]);

        if($goal_add){
            return redirect('admin/goals')->with('success','New Goal added successfully');
        }else{
            return redirect()->back()->with('error','Some error occured');
        }
    }
}
