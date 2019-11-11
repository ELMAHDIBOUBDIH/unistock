<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UploadInterface;
use File;

class ImageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UploadInterface $upload)
    {
        $this->upload = $upload;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
       
        $input = $request->all();
        $data['file'] = $request->file('file');
        $file = $this->upload->image($data, $request->type);
        return response()->json(array('success' => true, 'path' => $file['path']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        File::delete(public_path('uploads/'.$request->type.'/lg/' . $request->item));
        File::delete(public_path('uploads/'.$request->type.'/md/' . $request->item));
        File::delete(public_path('uploads/'.$request->type.'/sm/' . $request->item));
        File::delete(public_path('uploads/'.$request->type.'/xs/' . $request->item));
        return response()->json(array('success' => true));
    }
}
