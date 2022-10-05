<?php

namespace App\Http\Controllers\WebTraining\tutorial;

use App\Http\Controllers\Controller;
use App\Models\WebTraining;
use App\Models\WebTrainingAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;

class WebTrainingController extends Controller
{
    public function index(Request $request)
    {
        if (FacadesRequest::isMethod('get')) {
            return view('admin.web-training.index');
        } elseif (FacadesRequest::isMethod('post')) {
        } else {
        }
    }
    public function show()
    {
        if (FacadesRequest::isMethod('get')) {
            $web_tr_id = Session::get('web_tr_id');
            $heading = WebTraining::where('id', $web_tr_id)->select('heading')->get();
            // dd($heading->toArray());
            return view('admin.web-training.tutorial.create', ['heading' => $heading]);
        } else {
            return back();
        }
    }
    public function store(Request $request)
    {
        if (FacadesRequest::isMethod('post')) {
            if ($request->hasFile('fancy_upload')) {
                // dd(Session::get('web_tr_id'));
                $file = $request->file('fancy_upload');
                $extension = $file->getClientOriginalExtension();
                $file_original_name = $file->getClientOriginalName();
                $filename = $file_original_name . '.' . $extension;
                // dd($filename);

                $file->move('dist/img/tutorial', $filename);
                if (!empty(Session::get('web_tr_id'))) {
                    $web_tr_id = Session::get('web_tr_id');
                    WebTrainingAsset::insert([
                        'image' => $filename,
                        'web_tr_id' => $web_tr_id
                    ]);
                    return json_encode(true);
                }
            }
        } else {
            return json_encode(false);
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
    public function edit(Request $request, $id)
    {
        if (FacadesRequest::isMethod('get')) {
            // $heading = WebTraining::where('id', $request->id)->select('heading')->get();
            $web_trainings = WebTraining::with('web_trainings_assets')->where('id', $request->id)->get();

            return view('admin.web-training.tutorial.edit', ['web_trainings' => $web_trainings]);
        } else {
            return back();
        }
    }
    public function update(Request $request)
    {
        if (FacadesRequest::isMethod('post')) {
            if ($request->hasFile('fancy_upload')) {
                // dd(Session::get('web_tr_id'));
                $file = $request->file('fancy_upload');
                $extension = $file->getClientOriginalExtension();
                $file_original_name = $file->getClientOriginalName();
                $filename = $file_original_name . '.' . $extension;
                $file->move('dist/img/tutorial', $filename);
                if (!empty(Session::get('web_tr_id'))) {
                    $web_tr_id = Session::get('web_tr_id');
                    WebTrainingAsset::insert([
                        'image' => $filename,
                        'web_tr_id' => $web_tr_id
                    ]);
                }
            } elseif ($request->hasFile('file')) {
            }
        } else {
            return back();
        }
    }
}
