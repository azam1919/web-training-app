<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\Attandence;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session as FacadesSession;

class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app(UserController::class)->main();
            return $next($request);
        });
    }
    public function Logout(Request $request)
    {
        date_default_timezone_set("Asia/Karachi");
        if (session()->has('full_name')) {
            if (session()->has('user_name')) {
                if (session()->has('email')) {
                    $email =  session()->get('email');
                    User::where('email', $email)
                        ->update(
                            [
                                'status' => 0,
                            ]
                        );
                    FacadesSession::flush();
                    $email_cookie = Cookie::forget('emailcookie');
                    $password_cookie = Cookie::forget('passwordcookie');
                    return redirect('/admin')->withCookie($email_cookie)->withCookie($password_cookie);
                }
            }
        }
    }
}
