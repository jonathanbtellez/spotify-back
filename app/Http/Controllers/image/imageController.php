<?php

namespace App\Http\Controllers\image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class imageController extends Controller
{
    public function show($folder, $filename)
    {
        $path = storage_path("app/public/images/{$folder}/{$filename}");

        if (!file_exists($path)) {
            abort(404);
        }
    
        $file = file_get_contents($path);
        $type = mime_content_type($path);
    
        return response($file, 200)
            ->header('Content-Type', $type);
    }
}
