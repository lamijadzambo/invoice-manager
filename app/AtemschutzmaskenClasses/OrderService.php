<?php


namespace App\AtemschutzmaskenClasses;


use App\Models\Order;

class OrderService
{
    public static function save($orders)
    {
        foreach ($orders as $order) {
            $numberOfSavedOrders[] = (new OrderService)->createOrders($order);
        }

        return $numberOfSavedOrders;
    }

    public function createOrders($order)
    {
        $full_order = new Order;
        $full_order->id = $order->id;
        $status = $order->status;
       /* if ($status == 'processing') {
            $order_status = 'Bearbeitung';
        } elseif ($status == 'on-hold') {
            $order_status = 'Wartestellung';
        }
        $full_order->order_status = $order_status;*/
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

        foreach ($order->tax_lines as $tax) {
            $full_order->order_total_tax_amount = $tax->tax_total;
        }

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

//        foreach ($order->line_items as $product) {
//
//            $sku01 = '001';
//            $sku02 = '001-1-1';
//            $sku03 = '001-1';
//            $sku04 = '002';
//            $sku05 = '003';
//            $sku06 = 'Hyg';
//            $sku07 = '004';
//            $sku08 = 'Med';
//            $sku09 = '14-01';
//            $sku10 = '006';
//            $sku11 = '009';
//            $sku12 = '007';
//            $sku13 = '008';
//            $sku14 = '00-11';
//
//            if ($product->sku == $sku01) {
//                $quantities1[] = $product->quantity;
//                $product_quantity_1 = $this->getProductQuantity($quantities1);
//                $full_order->hyg_hg001 = $product_quantity_1;
//            } elseif ($product->sku == $sku02) {
//                $quantities2[] = $product->quantity;
//                $product_quantity_2 = $this->getProductQuantity($quantities2);
//                $full_order->typ_II = $product_quantity_2;
//            } elseif ($product->sku == $sku03) {
//                $quantities3[] = $product->quantity;
//                $product_quantity_3 = $this->getProductQuantity($quantities3);
//                $full_order->typ_IIR = $product_quantity_3;
//            } elseif ($product->sku == $sku04) {
//                $quantities4[] = $product->quantity;
//                $product_quantity_4 = $this->getProductQuantity($quantities4);
//                $full_order->n95_hg002 = $product_quantity_4;
//            } elseif ($product->sku == $sku05) {
//                $quantities5[] = $product->quantity;
//                $product_quantity_5 = $this->getProductQuantity($quantities5);
//                $full_order->schild_hg005 = $product_quantity_5;
//            } elseif ($product->sku == $sku06) {
//                $quantities6[] = $product->quantity;
//                $product_quantity_6 = $this->getProductQuantity($quantities6);
//                $full_order->hyg_red_masks = $product_quantity_6;
//            } elseif ($product->sku == $sku07) {
//                $quantities7[] = $product->quantity;
//                $product_quantity_7 = $this->getProductQuantity($quantities7);
//                $full_order->door_handler = $product_quantity_7;
//            } elseif ($product->sku == $sku08) {
//                $quantities8[] = $product->quantity;
//                $product_quantity_8 = $this->getProductQuantity($quantities8);
//                $full_order->med_einweg = $product_quantity_8;
//            } elseif ($product->sku == $sku09) {
//                $quantities9[] = +$product->quantity;
//                $product_quantity_9 = $this->getProductQuantity($quantities9);
//                $full_order->stoffmasken = $product_quantity_9;
//            } elseif ($product->sku == $sku10) {
//                $quantities10[] = $product->quantity;
//                $product_quantity_10 = $this->getProductQuantity($quantities10);
//                $full_order->trennwand = $product_quantity_10;
//            } elseif ($product->sku == $sku11) {
//                $quantities11[] = $product->quantity;
//                $product_quantity_11 = $this->getProductQuantity($quantities11);
//                $full_order->thermometer = $product_quantity_11;
//            } elseif ($product->sku == $sku12) {
//                $quantities12[] = $product->quantity;
//                $product_quantity_12 = $this->getProductQuantity($quantities12);
//                $full_order->hand_disinfection = $product_quantity_12;
//            } elseif ($product->sku == $sku13) {
//                $quantities13[] = $product->quantity;
//                $product_quantity_13 = $this->getProductQuantity($quantities13);
//                $full_order->flachendes = $product_quantity_13;
//            } elseif ($product->sku == $sku14) {
//                $quantities14[] = $product->quantity;
//                $product_quantity_14 = $this->getProductQuantity($quantities14);
//                $full_order->hand_spender = $product_quantity_14;
//            }
//        }

        $orderExist = Order::where('id', $order->id)->exists();
        if ($orderExist == false) {
            $numberOfSavedOrders = $order->id;
            $full_order->save();
        }
        if (isset($numberOfSavedOrders)) {
            return $numberOfSavedOrders;
        }
    }

//    public function getProductQuantity($quantities)
//    {
//        $quantity = $quantities[0];
//        for ($i = 1; $i < count($quantities); $i++) {
//            $quantity += $quantities[$i];
//        }
//        return $quantity;
//    }
}





