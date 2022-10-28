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
            $web_trainings = WebTraining::where('id', $web_tr_id)->select('heading')->get();
            // dd($heading->toArray());
            // $images = WebTrainingAsset::where('web_tr_id', $web_tr_id)->get();
            // $images = WebTrainingAsset::where('edit_status' , 1)->orderB('position')->get();
            $images = DB::table('web_trainings_assets')->where('edit_status', 0)->orderBy('position')->get();

            // ->orderBy('created_at', 'desc')->get();
            // Images getting through status
            // $statusImages = WebTrainingAsset::where('edit_status',0)->orderBy('position')->get();
            $statusImages = DB::table('web_trainings_assets')->where('edit_status', 1)->orderBy('position')->get();
            // return $statusImages;
            return view('admin.web-training.tutorial.create', ['web_trainings' => $web_trainings, 'statusImages' => $statusImages, 'images' => $images, 'web_trainings_asset' => json_decode($web_trainings_asset, true)]);
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
                $response = $file->move($upload_path, $image_full_name);
                //    return $response;
                //    $name = time().'.'.$file->extension();
                //    $file->move(public_path().'/dist/img/tutorial', $name);  
                //    $data[] = $name;  
                $fancy_upload[] = $image_url;
            }

            $web_tr_id = Session::get('web_tr_id');

            WebTrainingAsset::insert([
                'image' => implode('|', $fancy_upload),
                'web_tr_id' => $web_tr_id,
                'latitude' => null,
                'longitude' => null,
                'height' => null,
                'edit_status' => 1

            ]);
            $web_tr_id = Session::get('web_tr_id');

            $images = WebTrainingAsset::where('web_tr_id', $web_tr_id)->get();
            return back()->with('success', 'Your files has been successfully added');
        }
        if (!empty($request->description)) {
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
                'edit_status' => 1
            ]);
            $data = [
                'id' => $id,
                'description' => $description,
                'x' => $x,
                'y' => $y,
                'width' => $width,
                'height' => $height,
                'edit_status' => 1
            ];
            return json_encode($data);
        } else {
            echo "Description Required";
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

    public function updatePosition()
    {
        if (isset($_POST['update']) && isset($_POST['parentid'])) {
            foreach ($_POST['positions'] as $position) {
                $index = $position[0];
                $newPosition = $position[1];
                $update = DB::update("UPDATE web_trainings_assets SET position = '$newPosition' WHERE id='$index' AND web_tr_id = " . $_POST['parentid'] );
                if($update){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }


    public function storing(Request $request)
    {
        if (FacadesRequest::isMethod('get')) {
            return view('admin.web-training.test1');
            // return view('admin.web-training.test');
        } elseif (FacadesRequest::isMethod('post')) {
        } else {
        }
    }
    public function edit(Request $request, $id)
    {
        if (FacadesRequest::isMethod('get')) {
            $web_trainings_asset = WebTrainingAsset::all();
            // dd($web_trainings_asset);
            $web_trainings = WebTraining::where('id', $request->id)->get();
            // dd($heading->toArray());
            $images = WebTrainingAsset::where('web_tr_id', $request->id)->get();

            return view('admin.web-training.tutorial.edit', ['web_trainings' => $web_trainings, 'images' => $images, 'web_trainings_asset' => json_decode($web_trainings_asset, true)]);

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
