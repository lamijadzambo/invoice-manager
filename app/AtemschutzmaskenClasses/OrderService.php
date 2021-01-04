<?php


namespace App\AtemschutzmaskenClasses;


use App\Models\Order;

class OrderService
{
    public static function save($orders, $id)
    {
        foreach ($orders as $order) {
            $numberOfSavedOrders[] = (new OrderService)->createOrders($order, $id);
        }

        return $numberOfSavedOrders;
    }

    public function createOrders($order, $id)
    {
        $full_order = new Order;
        $full_order->id = $order->id;
        $full_order->project_id = $id;
        $full_order->order_status = $order->status;
        $full_order->order_date = $order->date_created;
        $full_order->customer_note = $order->customer_note;
        $full_order->payment_method_title = $order->payment_method_title;
        $full_order->card_discount_amount = 0.00; // check with Nadira
        $full_order->order_refund_amount = 0.00; // check with Reto
        $full_order->order_total_amount = $order->total;
        $full_order->discount_amount = $order->discount_total;
        $full_order->coupon_code = 'N/A';
        $full_order->discount_amount_tax = $order->discount_tax;

        foreach ($order->shipping_lines as $shipping) {

            $shipping_method_full = $shipping->method_title;
            $shipping_method_title = str_replace('Swiss Post Paket ', '', $shipping_method_full);
            $full_order->shipping_method_title = $shipping_method_title;
            $full_order->order_shipping_amount = $shipping->total;
        }

        $full_order->order_total_tax_amount = $order->total_tax;

        $full_order->billing_first_name = $order->billing->first_name;
        $full_order->billing_last_name = $order->billing->last_name;
        $full_order->billing_company = $order->billing->company;
        $full_order->billing_address = $order->billing->address_1;
        $full_order->billing_city = $order->billing->city;
        $full_order->billing_state_code = $order->billing->state;
        $full_order->billing_post_code = $order->billing->postcode;
        $full_order->billing_country_code = $order->billing->country;
        $full_order->billing_email = $order->billing->email;
        $full_order->billing_phone = $order->billing->phone;
        $full_order->shipping_company = $order->shipping->company;
        $full_order->shipping_first_name = $order->shipping->first_name;
        $full_order->shipping_last_name = $order->shipping->last_name;
        $full_order->shipping_address = $order->shipping->address_1;
        $full_order->shipping_city = $order->shipping->city;
        $full_order->shipping_state_code = $order->shipping->state;
        $full_order->shipping_post_code = $order->shipping->postcode;
        $full_order->shipping_country_code = $order->shipping->country;

        $full_order->products = json_encode($order->line_items);

        $orderExist = Order::where('id', $order->id)->exists();
        if ($orderExist == false) {
            $numberOfSavedOrders = $order->id;
            $full_order->save();
        }
        if (isset($numberOfSavedOrders)) {
            return $numberOfSavedOrders;
        }
    }

}





