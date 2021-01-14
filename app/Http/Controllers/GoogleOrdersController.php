<?php

namespace App\Http\Controllers;

use App\Models\Googlespreadsheet;
use App\Models\Order;
use App\Services\OrderTransformer;
use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;

class GoogleOrdersController extends Controller
{
    public function __invoke(Request $request, $project_id)
    {

        $lastInsertedOrder = Googlespreadsheet::where('project_id', $project_id)->get('order_id');
        $ids = $lastInsertedOrder;
        $order_id = 0;
        foreach($ids as $id){
            $order_id = $id->order_id;
        }

        $dbOrders = Order::where([['project_id', '=', $project_id], [ 'id', '>', $order_id]])->get();

        // FlipFlop orders ($project_id=2) have fewer columns; $columnLimit used to avoid empty columns
        if($project_id == 2){
            $columnLimit = '';
        }

        if(count($dbOrders)>0){
            $orders = OrderTransformer::transformOrder($dbOrders);
            $spreadSheetOrdersArray = [];
            $ids = [];
            foreach ($orders as $order) {

                $spreadSheetOrders = [
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

                $spreadSheetOrdersArray[] = $spreadSheetOrders;

            }

            if($project_id == 1){
                Sheets::spreadsheet(env('POST_SPREADSHEET_ID'))
                    ->sheetById(env('POST_SHEET_ID_ATEMSCHUTZMASKEN'))
                    ->append($spreadSheetOrdersArray);
            }elseif($project_id == 2){
                Sheets::spreadsheet(env('POST_SPREADSHEET_ID'))
                    ->sheetById(env('POST_SHEET_ID_FLIPFLOP'))
                    ->append($spreadSheetOrdersArray);
            }

            Googlespreadsheet::upsert(
                ['project_id' => $project_id, 'order_id' => $order->id, 'created_at' => now(), 'updated_at' => now()],
                'project_id',
                ['order_id', 'updated_at']
            );
            foreach($spreadSheetOrdersArray as $oneOrder){
                $ids[] = $oneOrder[6];
            }
            $request->session()->flash('success', 'New orders, starting from order ' . $ids[0] . ' have been added to your spreadsheet.');
        }else{
            $request->session()->flash('info', 'No new orders in database.');
        }
        return redirect()->route('index', $project_id);
    }

}




