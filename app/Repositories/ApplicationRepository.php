<?php

namespace App\Repositories;

use App\Models\Order;

class ApplicationRepository implements ApplicationRepositoryInterface
{

    public function allByIdDesc()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return $orders;
    }


    public function allByIdAsc()
    {
        $orders = Order::orderBy('id', 'asc')->get();
        return $orders;
    }


    public function findById($id)
    {
        $order = Order::findOrFail($id);
        return $order;
    }


    public function updateName($id){
        $order = Order::where('id', $id)->firstOrFail();
        $order->update(request()->only('name'));
        //return $this->format($order);
    }


    // in order to format all query results, use this function in this class or move it to the Order class (adjust the method call: return $order->format())
    /*protected function format($order)
    {
        return
            [ 'customer_id' => $order->id,
                'name' => $order->name ];
    }*/

}
