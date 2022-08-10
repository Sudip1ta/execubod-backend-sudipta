<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Validator;
use Hash;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $input = $request->all();

        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|numeric',
            'user_name'=>'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ];

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registration Failed',
                'errors' => $validator->errors()
            ]);
        }
 
        $user = User::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'user_name' => $input['user_name'],
            'gender'=>$input['gender'],
            'dob' =>  $input['dob'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'status'=>0
        ]);
         
        return response()->json([
            'success' => true,
            'message' => 'User registered succesfully.'
        ], 200);


        // $request->validate([
        //     'name' => 'required|string',
        //     'email' => 'required|string|email|unique:users',
        //     'password' => 'required|string|confirmed'
        // ]);
        // $user = new User([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password)
        // ]);
        // $user->save();
        // return response()->json([
        //     'message' => 'Successfully created user!'
        // ], 201);
    }
  
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        User::where('id',$user->id)->update([
            'last_login_at' => Carbon::now(),
            'api_token'=>$tokenResult->accessToken
        ]);

        return response()->json([
            'status'=>true,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
  
    public function userName_email_verify(Request $request)
    {   
        $checkEmail = User::where('email',$request->email)->count();

        $checkUserName = User::where('user_name',$request->userName)->count();

        return response()->json(['email'=>$checkEmail, 'userName'=>$checkUserName]);
    }


    public function logout(Request $request)
    {
        $user_id = Auth::user()->id;

        $request->user()->token()->revoke();

        User::where('id',$user_id)->update([
            'api_token'=>NULL
        ]);

        return response()->json([
            'status'=>true,
            'message' => 'Successfully logged out'
        ]);
    }
    
}
