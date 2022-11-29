<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    public function index()

    {
        return view('fileUpload');
    }

    public function store(Request $request)

    {

        $request->validate([

            'files' => 'required',

            'files.*' => 'required|mimes:jpg,png,pdf,xlx,csv',

        ]);

      

        $files = [];

        if ($request->file('files')){

            foreach($request->file('files') as $key => $file)

            {

                $fileName = time().rand(1,99).'.'.$file->extension();  

                $file->move(public_path('uploads'), $fileName);

                $files[]['name'] = $fileName;

            }

        }
        foreach ($files as $key => $file) {

            File::create($file);

        }
        return back()->with('success','You have successfully upload file.');

    }
}
