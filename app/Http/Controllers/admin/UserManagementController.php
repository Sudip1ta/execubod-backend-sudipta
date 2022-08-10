<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserInfo;
use Validator;
use Session;
use DateTime;
use DB;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at','DESC')->get();
        return view('admin.user.all_users_view',compact('users'));
    }


    public function user_update(Request $request)
    {
        $input = $request->all();

        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$request->user_id,
            'gender' => 'required|numeric',
            'user_name'=>'required',
            'user_id' => 'required|numeric'
        ];

        $validate = Validator::make($input,$rules);

        if ($validate->fails()) {
            return response()->json([
                'status' => 1,
                'message' => 'Error Occured',
                'errors' => $validate->errors()
            ]);
        }

        $user = User::find($input['user_id']);
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->user_name = $input['user_name'];
        $user->gender = $input['gender'];
        $user->email = $input['email'];
        $user->save();

         
        return response()->json([
            'status' => 0,
            'a' =>$user,
            'message' => 'User registered succesfully.'
        ], 200);
        
    }

    


    public function delete_user(Request $request)
    { 

        $user = User::find($request->user_id);

        $user->delete();

        if($user){
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
       
    }

    public function update_status(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->update;
        
        if( $user->save()){
            return response()->json(['status'=>1]);
        }else{
            return response()->json(['status'=>0]);
        }
    }


    public function user_add()
    {
        return view('admin.user.add_users');
    }

    public function user_information(Request $request, $id)
    {
        $user = User::find($id);

        $userInfo = UserInfo::where('user_id',$id)->first();

        $prev_goles = DB::table('user_goals')->where('user_id',$id)->where('current_goals',0)->get()->toArray();

        $dob = isset($user->dob) ? $user->dob : 0;
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        

        return view("admin.user.user_information_view",compact('user','userInfo','age','prev_goles'));

    }


    public function free_trial_user(Request $request)
    {
        $list = DB::table('apply_for_trial')
                ->join('workout_program','workout_program.id','=','apply_for_trial.program_id')
                ->join('users','users.id','=','apply_for_trial.user_id')
                ->select('apply_for_trial.*','first_name','last_name','title')
                ->orderBy('apply_for_trial.created_at','DESC')
                ->get()
                ->toArray();

        return view("admin.user.user_free_trial",compact('list'));
    }
}
