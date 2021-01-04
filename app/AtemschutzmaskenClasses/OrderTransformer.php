<?php

namespace App\AtemschutzmaskenClasses;

class OrderTransformer{

    public static function transformOrder($orders, $project_id)
    {
        foreach ($orders as $item) {
            $transformedOrders[] = (new OrderTransformer)->createOrder($item, $project_id);
        }
        return $transformedOrders;
    }

    public function createOrder($item, $project_id)
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

            $sku01 = '001';
            $sku02 = '001-1';
            $sku03 = '002';
            $sku04 = '003';
            $sku05 = '001-1-1';
            $sku06 = '004';
            $sku07 = '006';
            $sku08 = '009';
            $sku09 = '007';
            $sku10 = '008';
            $sku11 = '010';
            $sku12 = '00-11';
            $sku13 = '14-01';
            $sku14 = 'medEinweg';


                if ($product->sku == $sku01) {
                    $quantities1[] = $product->quantity;
                    $product_quantity_1 = $this->getProductQuantity($quantities1);
                    $order->typII = $product_quantity_1;
                }elseif ($product->sku == $sku02) {
                    $quantities2[] = $product->quantity;
                    $product_quantity_2 = $this->getProductQuantity($quantities2);
                    $order->typIIR = $product_quantity_2;
                }elseif ($product->sku == $sku03) {
                    $quantities3[] = $product->quantity;
                    $product_quantity_3 = $this->getProductQuantity($quantities3);
                    $order->hg002 = $product_quantity_3;
                }elseif ($product->sku == $sku04) {
                    $quantities4[] = $product->quantity;
                    $product_quantity_4 = $this->getProductQuantity($quantities4);
                    $order->hg005 = $product_quantity_4;
                }elseif ($product->sku == $sku05) {
                    $quantities5[] = $product->quantity;
                    $product_quantity_5 = $this->getProductQuantity($quantities5);
                    $order->redMask = $product_quantity_5;
                }elseif ($product->sku == $sku06) {
                    $quantities6[] = $product->quantity;
                    $product_quantity_6 = $this->getProductQuantity($quantities6);
                    $order->doorHandler = $product_quantity_6;
                }elseif ($product->sku == $sku07) {
                    $quantities7[] = $product->quantity;
                    $product_quantity_7 = $this->getProductQuantity($quantities7);
                    $order->trennwand = $product_quantity_7;
                }elseif ($product->sku == $sku08) {
                    $quantities8[] = $product->quantity;
                    $product_quantity_8 = $this->getProductQuantity($quantities8);
                    $order->thermometer = $product_quantity_8;
                }elseif ($product->sku == $sku09) {
                    $quantities9[] = $product->quantity;
                    $product_quantity_9 = $this->getProductQuantity($quantities9);
                    $order->handsmittel = $product_quantity_9;
                }elseif ($product->sku == $sku10) {
                    $quantities10[] = $product->quantity;
                    $product_quantity_10 = $this->getProductQuantity($quantities10);
                    $order->flachendes = $product_quantity_10;
                }elseif ($product->sku == $sku11) {
                    $quantities11[] = $product->quantity;
                    $product_quantity_11 = $this->getProductQuantity($quantities11);
                    $order->handSmilsan = $product_quantity_11;
                }elseif ($product->sku == $sku12) {
                    $quantities12[] = $product->quantity;
                    $product_quantity_12 = $this->getProductQuantity($quantities12);
                    $order->handSpender = $product_quantity_12;
                }elseif ($product->sku == $sku13) {
                    $quantities13[] = $product->quantity;
                    $product_quantity_13 = $this->getProductQuantity($quantities13);
                    $order->stoff = $product_quantity_13;
                }elseif ($product->sku == $sku14) {
                    $quantities14[] = $product->quantity;
                    $product_quantity_14 = $this->getProductQuantity($quantities14);
                    $order->medEinweg = $product_quantity_14;
                }

        }
        return $order;
    }

    public function getProductQuantity($quantities){
        $quantity = $quantities[0];
        for ($i = 1; $i < count($quantities); $i++) {
            $quantity += $quantities[$i];
        }
        return $quantity;
    }
}
