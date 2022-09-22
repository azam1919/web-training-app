<?php

namespace App\Http\Controllers;

use App\Models\WebTraining;
use App\Models\WebTrainingAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;

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
            if (!empty($request->heading)) {
                $heading = $request->heading;
                if (empty($request->status)) {
                    $status = '0';
                } else {
                    $status = '1';
                }
                $request->session()->pull('web_tr_id');

                WebTraining::insert([
                    'heading' => $heading,
                    'status' => $status,
                ]);
                $web_tr_id = DB::getPdo()->lastInsertId();

                $request->session()->put('web_tr_id', $web_tr_id);
                return back()->with('success', 'Heading Stored Successfully');
            } elseif (!empty($request->data)) {
                dd(1);
                if (!empty(Session::get('web_tr_id'))) {
                    $web_tr_id = Session::get('web_tr_id');
                    $image = $request->image;
                    WebTrainingAsset::insert([
                        'image' => $image,
                        'web_tr_id' => $web_tr_id
                    ]);
                }
                return "1";
            }
        } else {
            return back();
        }
    }
    public function storing(Request $request)
    {
        if (FacadesRequest::isMethod('get')) {
            return view('admin.web-training.test');
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
