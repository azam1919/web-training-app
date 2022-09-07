<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class WebTrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app(UserController::class)->main();
            return $next($request);
        });
    }
    public function index(Request $request)
    {
        if (FacadesRequest::isMethod('get')) {
            return view('admin.web-training.index');
        } elseif (FacadesRequest::isMethod('post')) {
        } else {
        }
    }
    public function store(Request $request)
    {
        if (FacadesRequest::isMethod('get')) {
            return view('admin.web-training.create');
        } elseif (FacadesRequest::isMethod('post')) {
        } else {
        }
    }
    public function update(Request $request)
    {
        if ($request->session()->has('full_name')) {
            return view('admin.dashboard.index');
        } else {
            return redirect('/');
        }
    }
    public function delete(Request $request)
    {
        if ($request->session()->has('full_name')) {
            return view('admin.dashboard.index');
        } else {
            return redirect('/');
        }
    }
}
