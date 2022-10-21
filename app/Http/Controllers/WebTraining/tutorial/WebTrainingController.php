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

            $web_trainings_asset = WebTrainingAsset::all();
            // dd($web_trainings_asset);
            $heading = WebTraining::where('id', $web_tr_id)->select('heading')->get();
            // dd($heading->toArray());
            $images = WebTrainingAsset::where('web_tr_id', $web_tr_id)->get();
            return view('admin.web-training.tutorial.create', ['heading' => $heading, 'images' => $images, 'web_trainings_asset' => json_decode($web_trainings_asset, true)]);
        } else {
            return back();
        }
    }
    public function store(Request $request)
    {
        // return $request;

        $fancy_upload = array();
        if ($request->hasfile('fancy_upload')) {
            foreach ($request->file('fancy_upload') as $file) {
                $image_name = md5(rand(1000, 10000));
                $exl = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $exl;
                $upload_path = 'dist/img/tutorial/';
                $image_url = $upload_path . $image_full_name;
                $file->move($upload_path, $image_full_name);
                //    return $response;
                //    $name = time().'.'.$file->extension();
                //    $file->move(public_path().'/dist/img/tutorial', $name);  
                //    $data[] = $name;  
                $fancy_upload[] = $image_url;
            }

            $web_tr_id = Session::get('web_tr_id');

            WebTrainingAsset::insert([
                'image' => implode('|', $fancy_upload),
                'web_tr_id' => 20,
                'latitude' => $request->y,
                'longitude' => $request->x,
                'height' => $request->height,
                'width' => $request->width

            ]);
            $web_tr_id = Session::get('web_tr_id');

            // $images = WebTrainingAsset::where('web_tr_id', $web_tr_id)->get();
            return back()->with('success', 'Your files has been successfully added');
        } else {
            $id = $request->id;
            $description = $request->description;
            $x = $request->x;
            $y = $request->y;
            $width = $request->width;
            $height = $request->height;

            WebTrainingAsset::where('id', $id)->update([
                'description' => $description,
                'longitude' => $x,
                'latitude' => $y,
                'width' => $width,
                'height' => $height,
            ]);
            $data = [
                'id' => $id,
                'description' => $description,
                'x' => $x,
                'y' => $y,
                'width' => $width,
                'height' => $height,
            ];
            return json_encode($data);
        }
        // $web_trainings= new WebTrainingAsset();
        // return $web_trainings;
        // $web_trainings->web_tr_id =  WebTraining::with('web_trainings_assets')->where('id', $request->id)->get();
        // $web_trainings->web_tr_id = 9;
        // $web_trainings->image=json_encode($data);
        // $web_trainings->image = $request->implode('|' , $fancy_upload); 
        // $web_trainings->save();

        // Azam's code 

        // if (FacadesRequest::isMethod('post')) {
        //     if ($request->hasFile('fancy_upload')) {
        // dd(Session::get('web_tr_id'));
        // $file = $request->file('fancy_upload');
        // $extension = $file->getClientOriginalExtension();
        // $file_original_name = $file->getClientOriginalName();
        // $filename = $file_original_name . '.' . $extension;
        // dd($filename);

        //         $file->move('dist/img/tutorial', $filename);
        //         if (!empty(Session::get('web_tr_id'))) {
        //             $web_tr_id = Session::get('web_tr_id');
        //             WebTrainingAsset::insert([
        //                 'image' => $filename,
        //                 'web_tr_id' => $web_tr_id
        //             ]);
        //             return json_encode(true);
        //         }
        //     }
        // } else {
        //     return json_encode(false);
        // }
        // Azam's code end
    }

    public function storing(Request $request)
    {
        if (FacadesRequest::isMethod('get')) {
            // $wTassets = WebTrainingAsset::where('web_tr_id',18)->limit(1)->get();
            $wTassets = WebTrainingAsset::where('id', 123)->get();
            // return $wTassets;
            return view('admin.web-training.test1',compact('wTassets'));
            // return view('admin.web-training.test');
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
