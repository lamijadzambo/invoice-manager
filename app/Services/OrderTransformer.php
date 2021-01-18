<?php

namespace App\Services;

use App\Helpers\Order;

class OrderTransformer{

    public static function transformOrder($orders)
    {
        foreach ($orders as $item) {
            $transformedOrders[] = self::createOrder($item);
        }
        return $transformedOrders;
    }

    public static function createOrder($item)
    {
        $order = new Order;
        $order->id = $item->id;
        $order->order_status = $item->order_status;
        $order->order_date = $item->order_date;
        $order->customer_note = $item->customer_note;
        $order->payment_method_title = $item->payment_method_title;
        $order->order_total_amount = $item->order_total_amount;
        $order->order_total_tax_amount = $item->order_total_tax_amount;
        $order->billing_company = $item->billing_company;
        $order->billing_first_name = $item->billing_first_name;
        $order->billing_last_name = $item->billing_last_name;
        $order->billing_address = $item->billing_address;
        $order->billing_city = $item->billing_city;
        $order->billing_state_code = $item->billing_state_code;
        $order->billing_post_code = $item->billing_post_code;
        $order->billing_country_code = $item->billing_country_code;
        $order->billing_email = $item->billing_email;
        $order->billing_phone = $item->billing_phone;
        $order->shipping_company = $item->shipping_company;
        $order->shipping_first_name = $item->shipping_first_name;
        $order->shipping_last_name = $item->shipping_last_name;
        $order->shipping_address = $item->shipping_address;
        $order->shipping_city = $item->shipping_city;
        $order->shipping_state_code = $item->shipping_state_code;
        $order->shipping_post_code = $item->shipping_post_code;
        $order->shipping_country_code = $item->shipping_country_code;
        $order->products = $item->products;

        foreach(json_decode($order->products) as $product){

            $skus = [
                '001', '001-1-1', '003AM', '004AM', '005AM', 'HYG', '007AM', 'MED', '009AM', '010AM',
                '011AM', '012AM', '013AM', '014AM', '015AM', '001FF', '002FF', '003FF', '004FF', '005FF', '006FF',
                '007FF', '008FF', '009FF'
            ];

            $sku = $product->sku;
            $foundSku = in_array($sku, $skus);

            if($foundSku){
                if($sku === '001'){
                    $order->hg001 += $product->quantity;
                }elseif ($sku === '001-1-1'){
                    $order->typII += $product->quantity;
                }elseif ($sku === '003AM'){
                    $order->typIIR += $product->quantity;
                }elseif ($sku === '004AM'){
                    $order->hg002 += $product->quantity;
                }elseif ($sku === '005AM'){
                    $order->hg005 += $product->quantity;
                }elseif ($sku === 'HYG'){
                    $order->redMask += $product->quantity;
                }elseif ($sku === '007AM'){
                    $order->doorHandler += $product->quantity;
                }elseif ($sku === 'MED'){
                    $order->medEinweg += $product->quantity;
                }elseif ($sku === '009AM'){
                    $order->stoff += $product->quantity;
                }elseif ($sku === '010AM'){
                    $order->trennwand += $product->quantity;
                }elseif ($sku === '011AM'){
                    $order->thermometer += $product->quantity;
                }elseif ($sku === '012AM'){
                    $order->handsmittel += $product->quantity;
                }elseif ($sku === '013AM'){
                    $order->flachendes += $product->quantity;
                }elseif ($sku === '014AM'){
                    $order->handSpender += $product->quantity;
                }elseif ($sku === '015AM'){
                    $order->ffp3 += $product->quantity;
                }elseif ($sku === '001FF'){
                    $order->switzerland += $product->quantity;
                }elseif ($sku === '002FF'){
                    $order->germany += $product->quantity;
                }elseif ($sku === '003FF'){
                    $order->austria += $product->quantity;
                }elseif ($sku === '004FF'){
                    $order->france += $product->quantity;
                }elseif ($sku === '005FF'){
                    $order->netherlands += $product->quantity;
                }elseif ($sku === '006FF'){
                    $order->italy += $product->quantity;
                }elseif ($sku === '007FF'){
                    $order->spain += $product->quantity;
                }elseif ($sku === '008FF'){
                    $order->england += $product->quantity;
                }elseif ($sku === '009FF'){
                    $order->portugal += $product->quantity;
                }
            }
        }
        return $order;
    }
}
