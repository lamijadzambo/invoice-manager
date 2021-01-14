<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Revolution\Google\Sheets\Facades\Sheets;

class GoogleOrdersController extends Controller
{
    public function __invoke()
    {
        $orders = Order::where('project_id', 1)->get();

        foreach ($orders as $order) {

            $append = [
                $order->billing_company,
                $order->billing_first_name,
                $order->billing_last_name,
                '',
                $order->billing_email,
                $order->billing_phone,
                $order->id,
                $order->order_status,
                /*(string)$order->hyg_hg001,
                (string)$order->typ_II,
                (string)$order->typ_IIR,
                (string)$order->n95_hg002,
                (string)$order->schild_hg005,
                (string)$order->hyg_red_masks,
                (string)$order->door_handler,
                (string)$order->med_einweg,
                (string)$order->stoffmasken,
                (string)$order->trennwand,
                (string)$order->thermometer,
                (string)$order->hand_disinfection,
                (string)$order->flachendes,
                (string)$order->hand_spender,*/
                (string)$order->order_total_amount,
            ];

            Sheets::spreadsheet(env('POST_SPREADSHEET_ID'))
                ->sheetById(env('POST_SHEET_ID'))
                ->append([$append]);
        }
        return redirect()->back();
    }

}




