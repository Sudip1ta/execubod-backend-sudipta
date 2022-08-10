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


        $id = DB::getPdo()->lastInsertId();

        $receiverNumber = trim($input['email']);

        $otp = rand(1111,9999);


        $hostname = env('MAIL_FROM_ADDRESS');

        $html='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>ExecuBod </title>
        </head>
        <body>
            <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
                <div class="box" style="width:80%; margin: 0 auto; border: 1px solid rgba(0, 0, 0, 0.212); padding: 30px 80px;">
                    <div style="font-size: 20px; color: gray;">
                        <p>Hello Administrator, </p>
                        <p>We\'ve received an Email From '.$request->email.' For Contact Us Form .</p>
                        
                        <p> Your OTP is : '.$otp. '</p>
                        
                    </div>
                </div>
            </div>
        </body>
        </html>';


            try {
                $maildata['messagebody_foruser'] = $html;
                $maildata['toemail'] =  $request->email;
                $maildata['fromemail'] = $hostname;
                $mail_send = Mail::send(array(), $maildata, function ($message) use ($maildata) {
                    $message->to($maildata['toemail'])
                        ->subject('Contact Us')
                        ->from($maildata['fromemail'], 'Remnant Tribe Network')
                        ->setBody($maildata['messagebody_foruser'], 'text/html');
                });
                    return response()->json([
                        'success' => true,
                        'message' => 'Email send successfully.',
                    ], 200);                    
                
            } catch (Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'error. Failed',
                ]);
            }









         
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
