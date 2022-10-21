<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WebTraining;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app(UserController::class)->main();
            return $next($request);
        });
    }
    public function admin_dashboard(Request $request)
    {
        $publishedTutorials = WebTraining::where('status',1)->count();
        $draftTutorials = WebTraining::where('status',0)->count();
        if ($request->session()->has('full_name')) {
            return view('admin.dashboard.index',compact('publishedTutorials','draftTutorials'));
        } else {
            return redirect('/');
        }
    }
}
