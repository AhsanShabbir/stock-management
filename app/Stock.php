<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    protected $table = "stock";

    protected $fillable = [
        'goods_name', 'quantity', 'base_price', 'selling_price', 'status', 'notifications'
    ];

    public function orders(){
        return $this->hasMany('App\OrdersDetails', 'stock_id', 'id');
    }
}
