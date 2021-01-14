<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Project;
use Carbon\Carbon;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;

class Word extends PhpWord
{
    public static function generateDoc($order, $project_id, $customer_id)
    {
        Settings::setOutputEscapingEnabled(true); // allows '&' in word docs

            if($project_id == Project::$atemshutz){
                $templateProcessor = new TemplateProcessor('word-template/atemschutz-word-template.docx');
            }elseif ($project_id == Project::$flipflop){
                $templateProcessor = new TemplateProcessor('word-template/flipflop-word-template.docx');
            }

        $templateProcessor->setValue('company', $order->shipping_company);
        $templateProcessor->setValue('name', $order->shipping_first_name);
        $templateProcessor->setValue('surname', $order->shipping_last_name);
        $templateProcessor->setValue('address', $order->shipping_address);
        $templateProcessor->setValue('postcode', $order->shipping_post_code);
        $templateProcessor->setValue('city', $order->shipping_city);
        $templateProcessor->setValue('order_id', $order->id);
        $templateProcessor->setValue('date', Carbon::now()->formatLocalized('%d. %B. %Y'));

        if($customer_id == "man"){
            $templateProcessor->setValue('message', Order::$message_man);
        }elseif($customer_id == "woman"){
            $templateProcessor->setValue('message', Order::$message_woman);
        }

        $templateProcessor->setValue('thank_you', Order::$thx_message);
        $templateProcessor->setValue('thank_you', Order::$thx_message);
        $templateProcessor->setValue('shipping', str_replace('Swiss Post Paket ', '', $order->shipping_method_title));

        foreach(json_decode($order->products) as $product){

            $array[] = ($product->name);
            $limit = count($array);

            for ($i = 0; $i < $limit; $i++) {
                $productName = str_replace(['<span>', '</span>'], '', $product->name);
                $templateProcessor->setValue('product_name' . $i, $productName);
                $templateProcessor->setValue('quantity' . $i, $product->quantity);
                $templateProcessor->setValue('stk' . $i, Order::$piece);
            }
        }

            $place_holder = null;
            $word_template_placeholders = 7;

            for ($i = $limit; $i < $word_template_placeholders; $i++) {
                $templateProcessor->setValue('product_name' . $i, $place_holder);
                $templateProcessor->setValue('color' . $i, $place_holder);
                $templateProcessor->setValue('quantity' . $i, $place_holder);
                $templateProcessor->setValue('stk' . $i, $place_holder);
            }

        $name = $order->shipping_first_name;
        $shipping_first_name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
        $surname = $order->shipping_last_name;
        $shipping_last_name = preg_replace('/[^A-Za-z0-9\-]/', '', $surname);

        $fileName = $shipping_first_name . ' ' . $shipping_last_name;
        $templateProcessor->saveAs($fileName . '.docx');

        return $fileName;
    }

}







