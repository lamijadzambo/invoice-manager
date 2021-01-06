<?php

namespace App\Http\Controllers\Atemschutzmasken;

use App\AtemschutzmaskenClasses\OrderTransformer;
use App\AtemschutzmaskenClasses\ProductAttributesService;
use App\AtemschutzmaskenClasses\ExcelService;
use App\AtemschutzmaskenClasses\ProductService;
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
            $productName = ProductService::fetchProductNames($project_id);
            return view('filtered.index', compact('orders', 'project_id', 'productName'));
        }else{
            $request->session()->flash('info', 'No orders in database.');
            return redirect()->route('index', $project_id);
        }
    }

    public function exportOrdersExcel($project_id, Request $request){
        $dbOrders = Order::where('project_id', $project_id)->get();
        if(count($dbOrders)>0) {
            return (new ExcelService($project_id))->download('Bestellungen.xlsx');
        }else{
            $request->session()->flash('info', 'No orders in database.');
            return redirect()->route('index', $project_id);
        }
    }

    public function exportProductColorsExcel($project_id, Request $request){
        $dbOrders = Order::where('project_id', $project_id)->get();
        if(count($dbOrders)>0) {
            return (new ProductAttributesService())->download('Produktfarbe.xlsx');
        }else{
            $request->session()->flash('info', 'No orders in database.');
            return redirect()->route('index', $project_id);
        }
    }
}
