<?php

namespace App\Services;

use App\Models\Order;

class OrderModel
{
    public static function save($orders, $project_id)
    {
        foreach ($orders as $apiOrder) {
            $numberOfSavedOrders[] = self::createOrders($apiOrder, $project_id);
        }
        return $numberOfSavedOrders;
    }

    public static function createOrders($apiOrder, $project_id)
    {
        $order = new Order;
        $order->id = $apiOrder->id;
        $order->project_id = $project_id;
        $order->order_status = $apiOrder->status;
        $order->order_date = $apiOrder->date_created;
        $order->customer_note = $apiOrder->customer_note;
        $order->payment_method_title = $apiOrder->payment_method_title;
        $order->card_discount_amount = 0.00;
        $order->order_refund_amount = 0.00;
        $order->order_total_amount = $apiOrder->total;
        $order->discount_amount = $apiOrder->discount_total;
        $order->coupon_code = 'N/A';
        $order->discount_amount_tax = $apiOrder->discount_tax;

        foreach ($apiOrder->shipping_lines as $shipping) {
            $shipping_method_full = $shipping->method_title;
            $shipping_method_title = str_replace('Swiss Post Paket ', '', $shipping_method_full);
            $order->shipping_method_title = $shipping_method_title;
            $order->order_shipping_amount = $shipping->total;
        }
        $order->order_total_tax_amount = $apiOrder->total_tax;
        $order->billing_first_name = $apiOrder->billing->first_name;
        $order->billing_last_name = $apiOrder->billing->last_name;
        $order->billing_company = $apiOrder->billing->company;
        $order->billing_address = $apiOrder->billing->address_1;
        $order->billing_city = $apiOrder->billing->city;
        $order->billing_state_code = $apiOrder->billing->state;
        $order->billing_post_code = $apiOrder->billing->postcode;
        $order->billing_country_code = $apiOrder->billing->country;
        $order->billing_email = $apiOrder->billing->email;
        $order->billing_phone = $apiOrder->billing->phone;
        $order->shipping_company = $apiOrder->shipping->company;
        $order->shipping_first_name = $apiOrder->shipping->first_name;
        $order->shipping_last_name = $apiOrder->shipping->last_name;
        $order->shipping_address = $apiOrder->shipping->address_1;
        $order->shipping_city = $apiOrder->shipping->city;
        $order->shipping_state_code = $apiOrder->shipping->state;
        $order->shipping_post_code = $apiOrder->shipping->postcode;
        $order->shipping_country_code = $apiOrder->shipping->country;
        $order->products = json_encode($apiOrder->line_items);

        $orderExist = Order::where('id', $apiOrder->id)->exists();

        if ($orderExist == false) {
            $numberOfSavedOrders = $apiOrder->id;
            $order->save();
        }

        if (isset($numberOfSavedOrders)) {
            return $numberOfSavedOrders;
        }
    }

}





