<?php

namespace App\Http\Controllers;

use App\Models\Googlespreadsheet;
use App\Models\Order;
use App\Models\Project;
use App\Services\ApiKeys;
use App\Services\OrderTransformer;
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

        // FlipFlop orders ($project_id=2) have fewer columns than AM; $columnLimit used to avoid empty columns
        if($project_id == Project::$flipflop){
            $columnLimit = '';
        }

        //$orderData = (new Spreadsheet)->setOrders($dbOrders, $project_id);

        if(count($dbOrders) > 0){
            $transformedOrders = OrderTransformer::transformOrder($dbOrders);

            foreach ($transformedOrders as $order) {
                $orders = [
                    $order->billing_company,
                    $order->billing_first_name,
                    $order->billing_last_name,
                    '',
                    $order->billing_email,
                    $order->billing_phone,
                    $order->id,
                    $order->order_status,
                    (string)$order->hg001 ?: (string)$order->germany,
                    (string)$order->typII ?: (string)$order->switzerland,
                    (string)$order->typIIR ?: (string)$order->italy,
                    (string)$order->hg002 ?: (string)$order->france,
                    (string)$order->hg005 ?: (string)$order->netherlands,
                    (string)$order->redMask ?: (string)$order->spain,
                    (string)$order->doorHandler ?: (string)$order->england,
                    (string)$order->medEinweg ?: (string)$order->austria,
                    (string)$order->stoff ?: (string)$order->portugal,
                    isset($columnLimit) ? (string)$order->order_total_amount : (string)$order->trennwand,
                    (string)$order->thermometer,
                    (string)$order->handsmittel,
                    (string)$order->flachendes,
                    (string)$order->handSpender,
                    isset($columnLimit) ? $columnLimit : (string)$order->order_total_amount,
                ];

                $spreadSheetOrders[] = $orders;
                $orderIds[] = $order->id;
            }

            $sheetApiKeys = ApiKeys::getSpreadsheetApiKeys($project_id);
            Sheets::spreadsheet($sheetApiKeys[0])->sheetById($sheetApiKeys[1])->append($spreadSheetOrders);

            $lastOrderId = end($orderIds);

            Googlespreadsheet::upsert(
                ['project_id' => $project_id, 'order_id' => $lastOrderId, 'created_at' => now(), 'updated_at' => now()],
                'project_id', ['order_id', 'updated_at']
            );

            $orderIds = array_reverse($orderIds);
            $firstNewOrderId = end($orderIds);

            $request->session()->flash('success', 'New orders, starting from order ' . $firstNewOrderId . ' have been exported to your spreadsheet.');
        }else{
            $request->session()->flash('info', 'No new orders in database.');
        }
        return redirect()->route('index', $project_id);
    }

}




