<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use App\Models\User;

use App\Models\AdminModel;

class AdminController extends Controller
{
    public function index()
    {
        
        if(is_numeric(Session::get('admin_id')))
        {
            return redirect('dashboard');
        }

        return view("admin.login");
    }


    public function login_verify(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:4'
        ],
        [
            'email.required' => "Email is required",
            'email.email' =>"Invalid Email id",
            'email.max' => "Email must be within 255 character",
            'password.required' => "Password is required"
        ]);

        $userdata = array(
            'email' => $request->email,
            'password' => $request->password
        );

        $admin = AdminModel::where('email',$request->email)->first();

        if(!empty($admin))
        {

            if(Hash::check($request->password, $admin->password))
            {
                Session::put('admin_id', $admin->id);
                return redirect('dashboard');
            }
            else
            {
                return redirect()->back()->with('error','Please check your password');
            }
            
        }
        else
        {
            return redirect()->back()->with('error','Email id is not register with us');
        }

    }
    
    
    public function dashboard()
    {
        $user_id = Session::get('admin_id');

        $admin = AdminModel::where('id',$user_id)->first();

        return view("admin.dashboard",compact('admin'));
    }

    public function logout(Request $request)
    {
        Session::flush();

        return redirect('login');
    }
}
