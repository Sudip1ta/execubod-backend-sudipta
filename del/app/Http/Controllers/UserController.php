<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;

use App\Models\User;
use App\Models\UserInfo;

class UserController extends Controller
{
    public function users(Request $request)
    {   
        $users = User::find(Auth::user()->id);

        return response()->json([
            'status'=>true,
            'data' => $users
        ]);
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
}
