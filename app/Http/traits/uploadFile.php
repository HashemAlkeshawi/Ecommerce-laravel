<?php

namespace App\Http\traits;

use Illuminate\Support\Facades\Storage;

trait uploadFile
{
    public function getUploadedImagePath($Image_file, $save_folder_name)
    {



        $Image_path = 'uploads/' . $save_folder_name . '/';
        $Image_name = time() . rand(1, 1000) . '.' . $Image_file->getClientOriginalExtension();
        $Image_full_path = $Image_path . $Image_name;
        $Image_file->storeAs('public', $Image_full_path);
        return $Image_full_path;
    }
}
