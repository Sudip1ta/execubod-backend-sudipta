<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;

use App\Models\User;
use App\Models\UserInfo;
use DB;

class UserController extends Controller
{
    public function users(Request $request)
    {   
        $users = User::select('id','first_name','last_name','gender','dob','user_name','email','occupation','last_login_at')->find(Auth::user()->id);

        return response()->json([
            'status'=>true,
            'data' => $users
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|numeric',
            'dob'=>'required|date'
        ];

        $input = $request->all();

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error Occured while updating',
                'errors' => $validator->errors()
            ]);
        }

        $user = User::find(Auth::user()->id);
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->gender = $input['gender'];
        $user->dob = $input['dob'];

        if(isset($input['occupation'])){
            $user->occupation = $input['occupation'];
        }
        
        if($user->save()){

            return response()->json([
                'status'=>true,
                'message'=>"Data Successfully Updated",
                'data'=>$user
            ],200);

        }else{

            return response()->json([
                'status'=>false,
                'message'=>"Some error occured",
            ]);
        }

    }
    
    /************ Store Users Personal Information  ***********/
    
    public function info_store(Request $request)
    {
        $user_id = Auth::user()->id;

        $input = $request->all();

        $user_info = UserInfo::firstOrNew(['id'=>$user_id]);

        if(isset($input['height'])){
            $user_info->user_id = $user_id; 
            $user_info->height = $input['height'];
            $user_info->save();
        }

        if(isset($input['goal'])){
            $user_info->user_id = $user_id; 
            $user_info->goals = $input['goal'];
            $user_info->save();
        }

        if(isset($input['weight'])){
            $user_info->user_id = $user_id; 
            $user_info->current_weight = $input['weight'];
            $user_info->target_weight = $input['target_weight'];
            $user_info->save();
        }

        if(isset($input['experience'])){
            $user_info->user_id = $user_id; 
            $user_info->experience = $input['experience'];
            $user_info->save();
        }

        if(isset($input['chest'])){
            $user_info->user_id = $user_id; 
            $user_info->chest = $input['chest'];
            $user_info->save();
        }

        if(isset($input['shoulder'])){
            $user_info->user_id = $user_id; 
            $user_info->shoulder = $input['shoulder'];
            $user_info->save();
        }

        if(isset($input['waist'])){
            $user_info->user_id = $user_id; 
            $user_info->waist = $input['waist'];
            $user_info->save();
        }

        if(isset($input['stomach'])){
            $user_info->user_id = $user_id; 
            $user_info->stomach = $input['stomach'];
            $user_info->save();
        }

        if(isset($input['calves'])){
            $user_info->user_id = $user_id; 
            $user_info->calves = $input['calves'];
            $user_info->save();
        }

        if(isset($input['thighs'])){
            $user_info->user_id = $user_id; 
            $user_info->thighs = $input['thighs'];
            $user_info->save();
        }


        if($user_info){
            return response()->json([
                'status'=>true,
                'message'=>"Data Successfully Updated",
                'data'=>$user_info
            ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>"Some Error Occured.Try again later..."
            ],500);
        }

       
    }


    public function user_info_fetch(Request $request)
    {
        $id = Auth::user()->id;

        $user = User::select('id','first_name','last_name','gender','dob','user_name','email','occupation','last_login_at')->find($id);

        $userInfo = UserInfo::select('id','user_id','height','current_weight','target_weight','chest','shoulder','waist','stomach','calves','thighs','goals','experience','profile_image_id','subscription_status')->where('user_id',$id)->first();

        $prev_goles = DB::table('user_goals')->select('id','user_id','goals')->where('user_id',$id)->where('current_goals',0)->get()->toArray();

        $user['user_info'] = $userInfo;
        $user['prev_goles'] = $prev_goles;

        if(!empty($user)){
            return response()->json([
                'status'=>true,
                'data'=>$user,
            ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>"Some Error Occured.Try again later..."
            ],500);
        }
        
    }
}
