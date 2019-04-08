<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    //
    protected  $table = 'clients';

    protected $fillable = [
        'name', 'email', 'cin', 'phone', 'address', 'city', 'status'
    ];

    public function orders(){
        return $this->hasMany('App\Orders', 'client_id', 'id');
    }
}
