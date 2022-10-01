<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        return view('admin.web-training.test1');
    }
    public function store(Request $request)
    {
        if ($request->hasFile('profile_image')) {

            //get filename with extension
            $filenamewithextension = $request->file('profile_image')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . uniqid() . '.' . $extension;

            Storage::put('public/profile_images/' . $filenametostore, fopen($request->file('profile_image'), 'r+'));
            Storage::put('public/profile_images/crop/' . $filenametostore, fopen($request->file('profile_image'), 'r+'));

            //Crop image here
            $cropimage = public_path('storage/profile_images/crop/' . $filenametostore);
            // $img = Image::make($cropimage)->crop($request->input('w'), $request->input('h'), $request->input('x1'), $request->input('y1'))->save($cropimage);

            // you can save the below image path in database
            $path = asset('storage/profile_images/crop/' . $filenametostore);

            return redirect('image')->with(['success' => "Image cropped successfully.", 'path' => $path]);
        }
    }
}
