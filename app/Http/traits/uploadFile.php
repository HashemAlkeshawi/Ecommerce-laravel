<?php

namespace App\Http\traits;

use Illuminate\Support\Facades\Storage;

trait uploadFile
{
    public function getUploadedImagePath($brand_Image_file, $save_folder_name)
    {



        $brand_Image_path = 'uploads/' . $save_folder_name . '/';
        $brand_Image_name = time() . rand(1, 1000) . '.' . $brand_Image_file->getClientOriginalExtension();
        $brand_Image_full_path = $brand_Image_path . $brand_Image_name;
        $brand_Image_file->storeAs('public', $brand_Image_full_path);
        return $brand_Image_full_path;
    }
}
