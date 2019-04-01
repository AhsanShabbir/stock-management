<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersDetails extends Model
{
    //
    protected $table = 'ordersDetails';

    protected $fillable = [
        'orders_id', 'stock_id', 'quantity', 'amount'
    ];

    public function stock(){
        return $this->hasMany('\App\Stock', 'stock_id', 'id');
    }
}
