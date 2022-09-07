<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function admin_forget_password(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|string|email|max:255',
            ],
            [
                'email.required' => '*required',
            ]
        );
        $email = $request->email;
        $to_email = $email;
        $request->session()->put('emails',  $email);
        // $data = array('name' => "Ogbonna", "body" => "A test mail");
        // Mail::send('/admin/ResetPassword', $data, function ($message) use ($to_email) {
        //     $message->to($to_email)
        //         ->subject('Reset Password');
        //     $message->from('bazam3592@gmail.com');
        // });
        $emailCheckForgetemail = User::where('email', '=', $request->input('email'))->first();
        if ($emailCheckForgetemail === null) {
            return back()->with('failed', "Email doesn't Exist");
        } else {
            return redirect('/admin/auth/reset');
        }
    }
    public function user_forget_password(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|string|email|max:255',
            ],
            [
                'email.required' => '*required',
            ]
        );
        $email = $request->email;
        $to_email = $email;
        // dd($request->toArray());
        $request->session()->put('emails',  $email);
        // $data = array('name' => "Ogbonna", "body" => "A test mail");
        // Mail::send('/user/auth/reset', $data, function ($message) use ($to_email) {
        //     $message->to($to_email)
        //         ->subject('Reset Password');
        //     $message->from('bazam3592@gmail.com');
        // });
        $EmailCheckForgetEmail = Employee::where('email', '=', $request->input('email'))->first();
        if ($EmailCheckForgetEmail == null) {
            return back()->with('failed', "Email doesn't Exist");
        } else {
            return redirect('/user/auth/reset');
        }
    }
}
