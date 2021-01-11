<?php

namespace App\Http\Controllers;

use App\Services\ApiKeys;
use App\Services\OrderModel;
use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index($project_id)
    {
        $orders = Order::where('project_id', $project_id)->orderBy('id', 'desc')->get();
        return view('orders.index', compact('orders', 'project_id'));
    }


    public function show($project_id, $id)
    {
        $order = Order::where('project_id', $project_id)->findOrFail($id);
        return view('orders.show', compact('order', 'project_id'));
    }


    public function get(Request $request, $project_id)
    {
        $orders = ApiKeys::getApiOrders($project_id);
        $numberOfSavedOrders = OrderModel::save($orders, $project_id);
        $orderIds = array_filter($numberOfSavedOrders);
        $order = end($orderIds);

        if (!empty($order)) {
            $request->session()->flash('success', 'New orders, starting from order ' . $order . ' have been added to your list.');
        } else {
            $request->session()->flash('info', 'No new orders.');
        }
        return redirect()->back();
    }


    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return back()->with('success', 'Order ' . $order->id . ' deleted.');
    }

    public function setStatus($id)
    {
        $order = Order::findOrFail($id);
        $status = 'printed';
        $order->print_status = $status;
        $order->save();
        return back()->with('success', 'Order ' . $order->id . ' printed.');
    }
}
