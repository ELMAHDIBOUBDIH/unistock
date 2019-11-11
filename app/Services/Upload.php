<?php

namespace App\Services;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;


class Upload implements UploadInterface {
    /**
     * Upload image
     *
     * @return boolean
     */
    public function image($input, $type)
    {
        
        switch ($type) {
            case 'articles':
                $now = Carbon::now();
                $date = $now->year . '/' . $now->month . '/';
                break;
            case 'products':
                $now = Carbon::now();
                $date = $now->year . '/' . $now->month . '/';
                break;
            case 'slides':
                $now = Carbon::now();
                $date = $now->year . '/' . $now->month . '/';
                break;
            case 'pattern':
                $now = Carbon::now();
                $date = $now->year . '/' . $now->month . '/';
                break;
            case 'images':
                $now = Carbon::now();
                $date = $now->year . '/' . $now->month . '/';
                break;
            default:
                $date = '';
                break;
        }

        $sizes = config('unistock.' . $type . '_image_sizes');
        $this->createFoldersIfNotExists($sizes, $date);
        $name = $this->preparedName(reset($sizes)['folder'], $date, $input);
        $image = [];
        foreach ($sizes as $key => $size) {
            if ($key == 'lg') {
                $x = $this->saveImage($input['file'], $name, $size['size'], $size['folder']);
                $image['x'] = '0';
                $image['y'] = '0';
                $image['w'] = $x->height();
                $image['h'] = $x->width();
            } else {
                $this->saveImage($input['file'], $name, $size['size'], $size['folder']);
            }
        }
        $image['path'] = $name;

        return $image;
    }
    public function pattern($input)
    {
        $now = Carbon::now();
        $folder =  'uploads/pattern/' . $now->year . '/' . $now->month . '/';

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 755, true);
        }
        //prepar name
        $file_name_slug = str_slug(pathinfo($input['upload']['filename'], PATHINFO_FILENAME));
        $extension = pathinfo($input['upload']['filename'] , PATHINFO_BASENAME);

        $original_name = $file_name_slug;
        $i = 1;

        while (file_exists($folder . $file_name_slug . $extension)) {
            $file_name_slug = (string) $original_name . '-' . $i;
            $i++;
        }

        $name = $file_name_slug . $extension;
        //end prepar name

        $image = Image::make($input['dataURL']);
        try {
            $image->save($folder . $name, 100);
            return $now->year . '/' . $now->month . '/' . $name;
        } catch (Exception $e) {
            $this->errors = 'There was a problem uploading your image.';
            return false;
        }
    }

    public function file($input, $type)
    {
        $now = Carbon::now();
        $date = $now->year . '/' . $now->month . '/';
        $folder = 'uploads/' . $type . '/files/' . $date;
        $this->createFoldersIfNotExists([['folder' => $folder]]);
        $name = $this->preparedName($folder, $date, $input);

        try {
            $input['file']->move($folder, $name);
        } catch (Exception $e) {
            $this->errors = 'There was a problem uploading your file.';
            return false;
        }

        return  $name;
    }

    public function preparedName($folder, $date, $input)
    {
        $file_name = $input['file']->getClientOriginalName();
        $file_name_slug = str_slug(pathinfo($file_name, PATHINFO_FILENAME));
        $extension = '.' . $input['file']->getClientOriginalExtension();

        $original_name = $file_name_slug;
        $i = 1;
        while (file_exists($folder . $date . $file_name_slug . $extension)) {
            $file_name_slug = (string) $original_name . '-' . $i;
            $i++;
        }

        $name = $date . $file_name_slug . $extension;

        return $name;
    }

    public function createFoldersIfNotExists($sizes, $date)
    {
        foreach ($sizes as $size) {
            if (!File::exists($size['folder'] . $date)) {
                File::makeDirectory($size['folder'] . $date, 755, true);
            }
        }
    }

    public function saveImage($inputImage, $name, $size, $folder)
    {
        $image = Image::make($inputImage);

        if (isset($size[1])) {
            if ($size[0] > 300) {
                if ($image->height() > $size[1]) {
                    $image->heighten($size[1]);
                }
                if ($image->width() > $size[0]) {
                    $image->fit($size[0], $size[1]);
                }
            } else {
                $image->fit($size[0], $size[1]);
            }
        } else {
            if ($image->width() > $size[0]) {
                $image->widen($size[0]);
            }
        }



        try {
            $image->save($folder . $name, 100);
            return $image;
        } catch (Exception $e) {
            $this->errors = 'There was a problem uploading your image.';
            return false;
        }
    }

       public function errors()
       {
           return $this->errors;
       }
}