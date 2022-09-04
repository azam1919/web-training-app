<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\Attandence;
use App\Models\Employee;
use App\Models\ModuleGroup;
use App\Models\ModulesGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

// use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app(UserController::class)->main();
            return $next($request);
        });
    }
    public function admin_login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6|max:255',
            ],
            [
                'email.required' => "*Email is required",
                'password.required' => "*Password is required",
            ]
        );
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', '=', $request->input('email'))->first();
        if ($user === null) {
            return back()->with('failed', "Email doesn't Exist");
        } else if (!Hash::check($password, $user->password) && ($password != '')) {
            return back()->with('failed', "Login Fail, pls check password")->with('email', $email);
        } else {
            $email = $user->email;
            $r_id = $user->r_id;
            $module_groups =  ModulesGroup::with('modules')->get();
            if ($request->has('RememberMe')) {
                $email_cookie =  Cookie::make('emailcookie', $email, time() + 86400);
                $password_cookie = Cookie::make('passwordcookie', $password, time() + 86400);
                $full_name = $user->full_name;
                $user_name = $user->user_name;
                $image = $user->image;
                $email = $user->email;
                $r_id = $user->r_id;
                $u_id = $user->id;
                User::where('email', $email)
                    ->update(
                        [
                            'status' => 1,
                        ]
                    );
                $selectStatus = User::where('email', '=', $email)->first();
                $request->session()->put('full_name', $full_name);
                $request->session()->put('user_name', $user_name);
                $request->session()->put('image',  $image);
                $request->session()->put('email',  $email);
                $request->session()->put('r_id',  $r_id);
                $request->session()->put('u_id',  $u_id);
                $request->session()->put('session_time',  time());
                $request->session()->put('status',  $selectStatus->Status);
                return redirect('/admin/dashboard')->with('module_groups', $module_groups)->withCookie($email_cookie)->withCookie($password_cookie);
            } else {
                $full_name = $user->full_name;
                $user_name = $user->user_name;
                $image = $user->image;
                $email = $user->email;
                $r_id = $user->r_id;
                $u_id = $user->id;
                User::where('email', $email)
                    ->update(
                        [
                            'status' => 1,
                        ]
                    );
                $select_status = User::where('email', '=', $email)->first();
                $request->session()->put('full_name', $full_name);
                $request->session()->put('user_name', $user_name);
                $request->session()->put('image',  $image);
                $request->session()->put('r_id',  $r_id);
                $request->session()->put('email',  $email);
                $request->session()->put('status',  $select_status->status);
                $request->session()->put('u_id',  $u_id);
                $request->session()->put('session_time',  time());
                return redirect('/admin/dashboard')->with('module_groups', $module_groups);
            }
        }
    }
}
