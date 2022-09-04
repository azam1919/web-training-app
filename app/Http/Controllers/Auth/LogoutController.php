<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeController;
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
            app(EmployeeController::class)->main();
            return $next($request);
        });
    }
    public function Logout(Request $request)
    {
        date_default_timezone_set("Asia/Karachi");
        if ($request->r_id == 3) {
            if (session()->has('first_name')) {
                if (session()->has('last_name')) {
                    if (session()->has('email')) {
                        $email =  session()->get('email');
                        Employee::where('email', $email)
                            ->update(
                                [
                                    'status' => 0,
                                ]
                            );
                        FacadesSession::flush();
                        $email_cookie = Cookie::forget('emailcookie');
                        $password_cookie = Cookie::forget('passwordcookie');
                        $date = date("Y-m-d");
                        $time_out = date("h:i:s A");
                        $e_id = Session::get('e_id');
                        Attandence::where([['e_id', '=', $e_id], ['date', '=', $date], ['time_out', '=', NULL]])
                            ->update(
                                [
                                    'time_out' => $time_out,
                                ]
                            );
                        return redirect('/')->withCookie($email_cookie)->withCookie($password_cookie);
                    }
                }
            }
        } else {
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
}
