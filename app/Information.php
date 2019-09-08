<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table ='information';
    protected $fillable = [
      'city',
      'country',
        'Barth_date',
        'user_id'
    ];

    public static function setInformations($data , $id)
    {
         $information = new self();
         $information->city = $data['city'];
         $information->country = $data['country'];
        (User::findOrFail($id))->information()->save($information);
    }

    public static function updateInformations($data , $id)
    {
        $information = (User::findOrFail($id))->information;
        $information->city = $data['city'];
        $information->country = $data['country'];
        $information->Barth_date = $data['Barth_date'];
        $information->save();
    }
}
