<?php

namespace App\Http\Controllers\Atemschutzmasken;

use App\AtemschutzmaskenClasses\OrderService;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Project;
use App\Repositories\ApplicationRepositoryInterface;
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('orders.index', compact('orders'));
    }


    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
    }


    public function get(Request $request)
    {
        $woocommerce = new Client(
            env('WOO_ENDPOINT'),
            env('WOO_CK'),
            env('WOO_CS'),
            [
                'wp_api' => true,
                'version' => 'wc/v3',
                'query_string_auth' => true,
            ]
        );

        /*$woocommerce = new Client(
            env('WOO_ENDPOINT_FLIPFLOP'),
            env('WOO_CK_FLIPFLOP'),
            env('WOO_CS_FLIPFLOP'),
            [
                'wp_api' => true,
                'version' => 'wc/v3',
                'query_string_auth' => true,
            ]
        );*/

        $params = [
            'per_page' => 100,
            'orderby' => 'date'
        ];

        $orders = $woocommerce->get('orders', $params);
        $numberOfSavedOrders = OrderService::save($orders);

        $orderIds = array_filter($numberOfSavedOrders);
        $order = end($orderIds);

        if (!empty($order)) {
            $request->session()->flash('success', 'New orders, starting from order ' . $order . ' have been added to your list.');
        } else {
            $request->session()->flash('info', 'No new orders.');
        }

        return redirect()->route('index');
    }


    public function delete($id)
    {
        $full_order = Order::findOrFail($id);
        $full_order->delete();
        return back()->with('success', 'Order deleted successfully.');
    }

    public function setStatus($id)
    {
        $full_order = Order::findOrFail($id);
        $status = 'printed';
        $full_order->print_status = $status;
        $full_order->save();
        return back()->with('success', 'Order printed successfully.');
    }
}
