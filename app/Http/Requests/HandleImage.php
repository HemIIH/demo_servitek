<?php

namespace App\Http\Requests;

trait HandleImage {

    /**
     * Upload image.
     *
     * @param $image
     * @param int $width
     * @param int $height
     * @param string $path
     *
     * @return \Intervention\Image\Image
     */
    protected function uploadImage($image, $width, $height, $path)
    {
        \Image::make($image->getRealPath())->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save(utf8_decode($path));
    }


    /**
     * Create a filename and make it lower case.
     *
     * @param $file
     *
     * @return string
     */
    protected function createFilename($file)
    {
        $extension = \File::extension($file->getClientOriginalName());
        $filename = date('U') . '.' . $extension;

        return \Str::lower($filename);
    }

}