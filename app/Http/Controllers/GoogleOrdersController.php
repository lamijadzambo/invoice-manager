<?php

namespace App\Http\Controllers;

use App\Models\Googlespreadsheet;
use App\Models\Order;
use App\Services\ApiKeys;
use App\Services\Spreadsheet;
use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;

class GoogleOrdersController extends Controller
{
    public function __invoke(Request $request, $project_id)
    {
        $lastInsertedOrder = Googlespreadsheet::where('project_id', $project_id)->get('order_id');

        $lastInsertedOrderId = 0;

        foreach($lastInsertedOrder as $order){
            $lastInsertedOrderId = $order->order_id;
        }

        $dbOrders = Order::where([['project_id', '=', $project_id], [ 'id', '>', $lastInsertedOrderId]])->get();

        $orderData = (new Spreadsheet)->setOrders($dbOrders, $project_id);

        $sheetApiKeys = ApiKeys::getSpreadsheetApiKeys($project_id);
        Sheets::spreadsheet($sheetApiKeys['spreadsheetId'])->sheetById($sheetApiKeys['sheetId'])->append($orderData['spreadSheetOrders']);

        $lastOrderId = end($orderData['orderIds']);

        Googlespreadsheet::upsert(
            ['project_id' => $project_id, 'order_id' => $lastOrderId, 'created_at' => now(), 'updated_at' => now()],
            'project_id', ['order_id', 'updated_at']
        );

        $orderIds = array_reverse($orderData['orderIds']);
        $firstNewOrderId = end($orderIds);

        if (!empty($firstNewOrderId)) {
            $request->session()->flash('success', 'New orders, starting from order ' . $firstNewOrderId . ' have been exported to your spreadsheet.');
        }else{
            $request->session()->flash('info', 'No new orders in database.');
        }
        return redirect()->route('index', $project_id);
    }

}




