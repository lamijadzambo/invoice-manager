<?php

namespace App\AtemschutzmaskenClasses;

class OrderExecutor{

    public static function save($allOrders, $id)
    {
        foreach ($allOrders as $item) {
            $savedOrder[] = (new OrderExecutor)->createOrder($item, $id);
        }

        return $savedOrder;
    }

    public function createOrder($item, $id)
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

            $order->product_sku = $product->sku;

            $meta_data = json_encode($product->meta_data);

            foreach(json_decode($meta_data) as $single_product){

                $order->product_value = $single_product->value;

            }
        }

        return $order;



    }
}
