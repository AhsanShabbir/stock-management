<?php

namespace App\Http\Controllers;

use App\Clients;
use App\Orders;
use App\OrdersDetails;
use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    //
    public function allOrders(Orders $orders, OrdersDetails $details)
    {
        $orders = $orders->all();
        return view('admin.orders.index', compact('orders'));
    }

    public function createOrder(Clients $clients)
    {
        return view('admin.orders.add');
    }

    public function orderPrice($id, Stock $stock)
    {
        $stock = $stock->where('id', $id)->select('selling_price', 'quantity', 'goods_name')->get()[0];
        return response($stock);
    }

    public function storeOrder(Orders $orders, OrdersDetails $details, Request $request, Stock $stock)
    {
       
        $count = count($request->quantity);
        $data = [''];
        $order = $orders->create([
            'total' => 0,
            'client_id' => $request->client
        ]);
        $total = 0;
        $id = $order->id;
        for ($i=0; $i < $count; $i++){
            if ($request->stock[$i] != '' & $request->quantity[$i] != ''){
                $selling_price =  $stock->where('id', $request->stock[$i])->get()[0];
                $data =  [
                    'orders_id' => $id,
                    'stock_id' => $request->stock[$i],
                    'quantity' => $request->quantity[$i],
                    'amount' => $selling_price->selling_price * $request->quantity[$i],
                ];
                $total  = $total + $data['amount'];
                $details->create($data);

                $oldQuantity = $stock->where('id', $request->stock[$i]);
                $newQuantity = $oldQuantity->get()[0]->quantity - $request->quantity[$i];
                $oldQuantity->update(['quantity' => $newQuantity]);
            }
        }

        $order->total = $total;

        $order->save();

        $redirectTo = route('orders.show', $order->id);

        //return Redirect::back()->withSuccess('The order is successfully created');
        return Redirect::to($redirectTo)->withSuccess('The order is successfully created');
    }

    public function showOrder($id, Orders $orders, OrdersDetails $ordersDetails)
    {

        $order = $orders->with('details.stock')->where('id', $id)->get()[0];

        // dd($order->toArray());
  


        $details = $orders->find($id)->details()->get();
        return view('admin.orders.show', compact('order', 'details'));
    }

    public function billOrder($id, Orders $orders, OrdersDetails $ordersDetails)
    {
        $order = $orders->where('id', $id)->get()[0];
        $details = $orders->find($id)->details()->get();
        return view('admin.orders.bill', compact('order', 'details'));
    }

    public function destroyOrder($id, Orders $orders, OrdersDetails $details)
    {
        
        //$details->where('orders_id', $id)->delete();
        $order = $orders->with('details.stock')->where('id', $id)->get()[0];
       // dd(count($order->details->toArray()));
        foreach($order->details->toArray() as $detail){
           // dd($detail);
           $stock = Stock::where('id', $detail['stock_id'])->first();
          // dd($stock);
           $stockBefore = $stock;
           $stock->quantity = $stock->quantity + $detail['quantity'];
           $stock->save();

           //dd($stockBefore, $stock);
        }
        
        $order->status = 'cancelled';
        $order->save();
        return Redirect('/orders')->withSuccess('The order is successfully cancelled');
    }

}
