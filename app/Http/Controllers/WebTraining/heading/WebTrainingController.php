<?php

namespace App\Http\Controllers\WebTraining\heading;

use App\Http\Controllers\Controller;
use App\Http\Requests\web_training\heading\store;
use App\Http\Requests\web_training\heading\update;
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
            $web_trainings = WebTraining::get();
            return view('admin.web-training.index', ['web_trainings' => $web_trainings]);
        } elseif (FacadesRequest::isMethod('post')) {
        } else {
        }
    }
    public function show()
    {
        if (FacadesRequest::isMethod('get')) {
            return view('admin.web-training.heading.create');
        } else {
            return back();
        }
    }
    public function store(store $request)
    {
        if (FacadesRequest::isMethod('post')) {
            $heading = $request->heading;
            $status = $request->status;
            $request->session()->pull('web_tr_id');

            WebTraining::insert([
                'heading' => $heading,
                'status' => $status,
            ]);
            $web_tr_id = DB::getPdo()->lastInsertId();

            $request->session()->put('web_tr_id', $web_tr_id);
            return redirect()->route('tutorial.create.show')->with('success', 'Heading Stored Successfully');
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
    // public function edit(Request $request, $id)
    // {
    //     if (FacadesRequest::isMethod('get')) {
    //         $web_trainings = WebTraining::where('id', $request->id)->get();
    //         return view('admin.web-training.heading.edit', ['web_trainings' => $web_trainings]);
    //     } else {
    //         return back();
    //     }
    // }
    public function update(update $request)
    {
        if (FacadesRequest::isMethod('post')) {
            $heading_count =  WebTraining::where('heading', $request->heading)->get();
            $id = $request->id;
            $heading = $request->heading;
            $status = $request->status;
            // dd($heading_id);
            // dd($heading_count->count());
            if ($heading_count->count() <= 1 && $id == $heading_count[0]->id) {
                WebTraining::where('id', $id)->update([
                    'heading' => $heading,
                    'status' => $status,
                ]);
                $array['heading'] = $heading;
                $array['status'] = $status;
                $array['success'] = "Data Updated Successfully";
                return json_encode($array);
            } else {
                echo "Heading Name Already Exist";
            }
        } else {
            return back();
        }
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        WebTraining::where('id', $id)->delete();
        WebTrainingAsset::where('web_tr_id', $id)->delete();
        return back();
    }
}
