<?php

namespace App\Services;
use Automattic\WooCommerce\Client;

class ApiKeys{

    public static function getApiOrders($project_id){
        $woocommerce = self::getApiKeys($project_id);
        $params = self::setParameters();
        $orders = $woocommerce->get('orders', $params);
        return $orders;
    }

    public static function getApiKeys($project_id){
        if($project_id == 1){
            $endPoint = env('WOO_ENDPOINT_ATEMSCHUTZ');
            $clientKey = env('WOO_CK_ATEMSCHUTZ');
            $clientSecret = env('WOO_CS_ATEMSCHUTZ');
        }elseif ($project_id == 2){
            $endPoint = env('WOO_ENDPOINT_FLIPFLOP');
            $clientKey = env('WOO_CK_FLIPFLOP');
            $clientSecret = env('WOO_CS_FLIPFLOP');
        }

        $woocommerce = new Client( $endPoint, $clientKey, $clientSecret,
            [
                'wp_api' => true,
                'version' => 'wc/v3',
                'query_string_auth' => true,
            ]
        );
        return $woocommerce;
    }


    public static function setParameters(){
        $params = [
            'per_page' => 100,
            'orderby' => 'date'
        ];
        return $params;
    }

    //FUNCTION TO GET PRODUCT NAMES DIRECTLY FROM API
//    public static function getApiProducts($project_id){
//        $woocommerce = self::getApiKeys($project_id);
//        $params = self::setParameters();
//        $products = $woocommerce->get('products', $params);
//        return $products;
//    }

}
