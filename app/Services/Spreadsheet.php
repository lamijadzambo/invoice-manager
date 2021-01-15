<?php

namespace App\Services;

use App\Models\Project;

class Spreadsheet
{


    public function setOrders($dbOrders, $project_id){

        // FlipFlop orders ($project_id=2) have fewer columns than AM; $columnLimit used to avoid empty columns
        if ($project_id == Project::$flipflop) {
            $columnLimit = '';
        }

        if (count($dbOrders) > 0) {
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
        }
        $orderData = [$spreadSheetOrders, $orderIds];

        return $orderData;
    }
}
