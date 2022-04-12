<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class StorageController extends Controller
{

    public function __construct()
    {
        $this -> middleware('permission:browse_documents');
    }
    public function getDocument(Request $request, String $filename)
    {
        // get current user 
        $user = Auth::user();

        // file path using base path
        $file_path = base_path() . '\private_documents\\' . $filename;

        // check if file exists at file path 
        if (!file_exists($file_path)) {
            // return 404 code as response. 
            return abort(404);
        }

        // get file extension
        $extension = pathinfo($file_path, PATHINFO_EXTENSION);

        // get mime type using extension
        $mime_type = mime_content_type($file_path);

        // return file as response
        return response()->file($file_path, [
            'Content-Type' => $mime_type
        ]);

    }
}
