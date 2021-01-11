<?php

namespace App\Http\Controllers;

use App\Services\OrderTransformer;
use App\Services\ProductAttributes;
use App\Services\Excel;
use App\Services\ProductNames;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function index($project_id, Request $request)
    {
        $dbOrders = Order::where('project_id', $project_id)->get();
        if(count($dbOrders)>0){
            $orders = OrderTransformer::transformOrder($dbOrders);
            $productName = ProductNames::fetchProductNames();
            return view('filtered.index', compact('orders', 'project_id', 'productName'));
        }else{
            $request->session()->flash('info', 'No orders in database.');
            return redirect()->route('index', $project_id);
        }
    }

    public function exportOrdersExcel($project_id, Request $request){
        $dbOrders = Order::where('project_id', $project_id)->get();
        if(count($dbOrders)>0) {
            return (new Excel($project_id))->download('Bestellungen.xlsx');
        }else{
            $request->session()->flash('info', 'No orders in database.');
            return redirect()->route('index', $project_id);
        }
    }

    public function exportProductColorsExcel($project_id, Request $request){
        $dbOrders = Order::where('project_id', $project_id)->get();
        if(count($dbOrders)>0) {
            return (new ProductAttributes())->download('Produktfarbe.xlsx');
        }else{
            $request->session()->flash('info', 'No orders in database.');
            return redirect()->route('index', $project_id);
        }
    }
}
