<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

Trait ImageUpload
{

    /**
     * Image upload trait used in controllers to upload files
     * @param string $file
     * @param string $folder
     * @param string $width
     * @param string $height
     * @return string
     * @throws \Exception
     */
    public function saveImages($file='', $folder='', $width = 500, $height = 500)
    {
        $destinationPath = '/'.$folder.'/';

        $file_name = random_int(1,100).date('Ymd').time().'.'.$file->getClientOriginalExtension();

        $image = Image::make($file);
        
        $image->resize($width, $height, function ($constraint) {
              $constraint->aspectRatio();
        })->save(public_path() . $destinationPath . $file_name);

        return $file_name;
    }

}