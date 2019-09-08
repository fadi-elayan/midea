<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Command extends Model
{
    protected $fillable = ['command' , 'user_id' , 'post_id'];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public static function deleteCommand($command)
    {
        foreach ($command as $commads)
            $commads->delete();
    }

    public static function uploadCommand($data)
    {
        $command = new self();
        $command->command = $data['command'];
        $command->user_id = Auth::user()->id;
        $command->post_id = $data['post_id'];
        $command->save();
        return $command->id;
    }

    public static function getCommend($post_id , $user_id)
    {
        return DB::table('commands')
            ->where('post_id' , $post_id)
            ->where('user_id' , $user_id)
            ->orderBy('created_at' , 'DESC')
            ->get();
    }
}
