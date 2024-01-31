<?php
namespace App\Services;
use Illuminate\Support\Facades\Storage;

class FileUploadService{
    
    /**
     * Upload file.
     *
     * @param string $path
     * @param mixed $file
     * @return string
     */
    public function upload($file, string $path){
        return Storage::put("public/$path", $file);
    }

    /**
     * Destroy file.
     *
     * @param string $path
     * @return mixed
     */
    public function delete(string $path){
        Storage::delete($path);
    }

    /**
     * Get image by path.
     *
     * @param string $path
     * @return mixed
     */
    public function get(string $path){
        return Storage::get($path);
    }
    
    /**
     * Get file mime type.
     *
     * @param string $path
     * @return mixed
     */
    public function getMimeType(string $path){
        return Storage::mimeType($path);
    }
}   