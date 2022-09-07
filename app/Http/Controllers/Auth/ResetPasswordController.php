<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function admin_reset_password(Request $request)
    {
        $request->validate(
            [
                'password' => 'required|string|min:8|max:255',
            ],
            [
                'password.required' => "*Password is required",
            ]
        );
        $email = $request->email;
        $password = $request->password;
        $Hashpassword = Hash::make($password);
        if ($password != null) {
            User::where('email', $email)
                ->update(
                    [
                        'password' => $Hashpassword,
                    ]
                );
            $request->session()->pull('emails');
            return redirect('/admin')->with('UpdatedSuccess', "Password Updated Successfully");
        } else {
            return back();
        }
    }
    public function user_reset_password(Request $request)
    {
        $request->validate(
            [
                'password' => 'required|string|min:8|max:255',
            ],
            [
                'password.required' => "*Password is required",
            ]
        );
        $email = $request->email;
        $password = $request->password;
        $hashing_password = Hash::make($password);
        if ($password != null) {
            Employee::where('email', $email)
                ->update(
                    [
                        'password' => $hashing_password,
                    ]
                );
            $request->session()->pull('emails');
            return redirect('/')->with('UpdatedSuccess', "Password Updated Successfully");
        } else {
            return back();
        }
    }
}
