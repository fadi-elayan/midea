<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Like extends Model
{
    protected $fillable = ['post_id' , 'user_id'];

    public static function deleteLike($like)
    {
        $like->delete();
    }
    public static function uploaudLike($data)
    {
        $like = new self();
        $like->user_id = $data['user_id'];
        $like->post_id = $data['post_id'];
        $like->save();
    }
    public static function isMyLike($post_id , $user_id)
    {
         return (DB::table('likes')
            ->where('post_id' , $post_id)
            ->where('user_id' , $user_id)
            ->get())
            ->isEmpty();
    }
}
