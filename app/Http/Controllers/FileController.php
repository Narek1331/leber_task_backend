<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    /**
     * FileUploadService instance.
     *
     * @return void
     */
    public function __construct(FileUploadService $file_upload_service)
    {
        $this->file_upload_service = $file_upload_service;
    }

    /**
     * Get image by image path.
     *
     * @param Request $request
     */
    public function index(Request $request){
        
        if($request->image_path){
            $image = $this->file_upload_service->get($request->image_path);
            $mimeType = $this->file_upload_service->getMimeType($request->image_path);
            return response($image)->header('Content-Type', $mimeType);
        }
    }
}
