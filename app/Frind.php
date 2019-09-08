<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Frind extends Model
{
    protected $fillable = ['user_id' , 'frind_id'];
    public static function deleteFrind($id)
    {
        $frinds = Auth::user()->frind;
        foreach ($frinds as $frind)
            if($frind->frind_id == $id){
                $frind->delete();
                break;
            }
        $frinds = User::findOrFail($id)->frind;
        foreach ($frinds as $frind)
            if($frind->frind_id == Auth::user()->id){
                $frind->delete();
                break;
            }
    }

    public static function insertFriend($id , $freind_id)
    {
            $freind =new self();
            $freind->frind_id = $freind_id;
            User::find($id)->frind()->save($freind);
            $freind1 = new self();
            $freind1->frind_id = $id;
             User::find($freind_id)->frind()->save($freind1);
    }
}
