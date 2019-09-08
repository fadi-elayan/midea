<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function frind()
    {
        return $this->hasMany('App\Frind');
    }
    public function image()
    {
        return $this->morphOne('App\Image' , 'imageable');
    }

    public function post()
    {
        return $this->hasMany('App\Post');
    }
    public function information()
    {
        return $this->hasOne('App\Information' );
    }
    public static function  setInformation($data , $id)
    {
        Information::setInformations($data ,$id);
    }

    public static function updateInformation($data , $id)
    {
        Information::updateInformations($data->all() ,$id);
       if(User::find($id)->image->path != '125.png')
           Image::deleteImage(User::find($id)->image);
        $image = self::find($id)->image ;
        $image->path = (Image::uploadImage($data->file('file')))->path;
        $image->save();
    }
    public static function getUser($id)
    {
        return self::findOrFail($id);
    }
    public static function getUsers($id){
        return self::where('id' , $id)
            ->orWhere('email' , 'like' ,'%'.$id.'%')
            ->orWhere('name' ,'like' ,'%'.$id.'%')
            ->paginate(10);
    }
    public static function isMyFrind($id)
    {
        $frinds =  Auth::user()->frind;
        foreach ($frinds as $frind){
            if($frind->frind_id == $id)
                return true;
        }
        return false;
    }

    public static function isAddFrindRequest($id)
    {
       return (DB::table('notifications')
            ->where('type' , 'App\Notifications\FrindRequestNotification')
            ->where('data' ,'like' , '%"frind_id":'.Auth::user()->id.',"user_id":"'.$id.'"%')
            ->where('read_at' ,  null)
            ->get());
    }
    public static function getNotification($id)
    {
       return   (DB::table('notifications')
           ->where('type' , 'App\Notifications\FrindRequestNotification')
           ->where('notifiable_id' ,$id)
           ->where('read_at' ,  null)
           ->get());
    }

    public static function getNotificationFrindPaginat($id)
    {
        return   (DB::table('notifications')
            ->where('type' , 'App\Notifications\FrindRequestNotification')
            ->where('notifiable_id' ,$id)
            ->where('read_at' ,  null)
            ->paginate(5));
    }

    public static function getNotificationlikeAndCommint($id)
    {
        return   (DB::table('notifications')
                     ->where('type' , 'App\Notifications\CommendsNotification')
                      ->orWhere('type' , 'App\Notifications\LikeNotification')
                       ->where('read_at' ,  null))
            ->where('notifiable_id' , $id)
            ->orderBy('created_at' , 'DESC')
            ->paginate(5);
    }



}
