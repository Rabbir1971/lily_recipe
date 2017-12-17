<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $fillable = [
        'uri',
    ];
    public $timestamps = false;

    public function users(){
        return $this->belongsToMany('App\User');
    }
}
