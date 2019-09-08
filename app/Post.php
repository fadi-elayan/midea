<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Post extends Model
{

    protected $fillable = ['post'];
    public function image()
    {
        return $this->morphMany('App\Image' , 'imageable');
    }

    public function video()
    {
        return $this->morphMany('App\Video' , 'videoable');
    }

    public function command()
    {
        return $this->hasMany('App\Command');
    }

    public function like()
    {
        return $this->hasMany('App\Like');
    }

    public static function uploadPost($request)
    {
        $post = new Post();
        $post->post = $request->input('post');
        Auth::user()->post()->save($post);
        $files = $request->file('files');
         try {
             foreach ($files as $file) {
                 $post->image()->save(Image::uploadImage($file));
             }
         }catch (\Exception $e)
         {

         }
    }

    public static function deletePost($post)
    {
        $post->delete();
    }

    public static function getPost($id)
    {
        return DB::table('posts')
            ->where('user_id' , $id)
            ->orderBy('created_at' , 'DESC')
            ->paginate(5);
    }

    public static function getPostForMyFriend($id)
    {
        $frind  = DB::table('frinds')
            ->select('user_id')
            ->where('frind_id' , $id);
        return  DB::table('posts')
            ->joinSub($frind, 'frinds', function ($join) {
                $join->on('posts.user_id', '=', 'frinds.user_id');
            })
            ->orderBy('created_at' , 'DESC')
            ->paginate(5);

    }

}
