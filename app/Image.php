<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path' , 'imageable_id' , 'imageable_type'];
    public static function saveImage()
    {
        $image = new self();
        $image->path = '125.png';
        return $image;
    }
    public static function uploadImage($image)
    {
        $photo = new Image();
        $path = '125.png';
        $date = new DateTime();
        if($files = $image){
            $name = $date->format('u');
            $name .= $files->getClientOriginalName();
            $files->move('image' , $name);
            $file['path'] = $name;
            $path = $file['path'];
        }
        $photo->path = $path;
        return $photo;
    }

    public static function deleteImage($image)
    {
        if (file_exists('image/'.$image->path)){
            unlink('image/'.$image->path);
        }
        $image->delete();
    }
    public static function removeImage($image)
    {
        if (file_exists('image/' . $image->path)) {
            unlink('image/' . $image->path);
        }
    }
}
