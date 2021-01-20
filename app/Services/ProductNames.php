<?php

namespace App\Services;

use App\Helpers\Product;

class ProductNames{

    public static function fetchProductNames(){

        $product = new Product();
        $product->hg001 = 'HG-001';
        $product->typII = 'TYP II';
        $product->typIIR = 'TYP IIR';
        $product->hg002 = 'N95 HG-002';
        $product->hg005 = 'SHILD HG-005';
        $product->redMask = 'HYG ROTE MASKEN';
        $product->doorHandler = 'DOORHANDLER';
        $product->medEinweg = 'MED EINWEG';
        $product->stoff = 'STOFFMASKEN';
        $product->trennwand = 'TRENNWAND';
        $product->thermometer = 'THERMOMETER';
        $product->handsmittel = 'HANDDESINFEKTIONSMITTEL';
        $product->flachendes = 'FLÄCHENDES.';
        $product->handSpender = 'HAND SPENDER';
        $product->ffp2 = 'N95 HG-002-2';
        $product->ffp3 = 'FFP3';
        $product->germany = 'DEUTSCHLAND';
        $product->switzerland = 'SCHWEIZ';
        $product->italy = 'ITALIEN';
        $product->france = 'FRANKREICH';
        $product->netherlands = 'NIEDERLANDE';
        $product->spain = 'SPANIEN';
        $product->england = 'ENGLAND';
        $product->austria = 'ÖSTERREICH';
        $product->portugal = 'PORTUGAL';

        return $product;
    }
}

        //FUNCTION TO STORE PRODUCT NAMES FROM API INTO THE OBJECT VARIABLES
//    public static function fetchProductNames($project_id){
//
//        $products = ApiKeys::getApiProducts($project_id);
//
//        foreach ($products as $product){
//            $apiProductNames[] = $product->name;
//        }
//
//        $product = new Product();
//
//        foreach($apiProductNames as $productName){
//
//            if($productName === 'HG001'){
//                $product->hg001 = 'HG-001';
//            }
//            elseif ($productName === 'TYP II') {
//                $product->typII = 'TYP II';
//            }
//            elseif ($productName === 'HUM Chirurgische Einwegmasken Typ IIR'){
//                $product->typIIR = 'TYP IIR';
//            }
//            elseif ($productName === 'Atemschutzmasken N95 / KN95 / FFP2 (HG-002)'){
//                $product->hg002 = 'N95 HG-002';
//            }
//            elseif ($productName === 'Gesichtsschutzmaske mit Kunststoffschild (HG-005)'){
//                $product->hg005 = 'SHILD HG-005';
//            }
//            elseif ($productName === 'Bedruckbare Maske für das Gesicht (für Mund und Nase)'){
//                $product->redMask = 'HYG ROTE MASKEN';
//            }
//            elseif ($productName === 'Doorhandler'){
//                $product->doorHandler = 'DOORHANDLER';
//            }
//            elseif ($productName === 'Medical'){
//                $product->medEinweg = 'MED EINWEG';
//            }
//            elseif ($productName === 'WELTNEUHEIT - Stoffmasken mit FFP2 Eigenschaften'){
//                $product->stoff = 'STOFFMASKEN';
//            }
//            elseif ($productName == 'Trennwände aus Plexiglas im eleganten Design'){
//                $product->trennwand = 'TRENNWAND';
//            }
//            elseif ($productName == 'Infrarot Thermometer'){
//                $product->thermometer = 'THERMOMETER';
//            }
//            elseif ($productName == 'Handdesinfektionsmittel 1Liter'){
//                $product->handsmittel = 'HANDDESINFEKTIONSMITTEL';
//            }
//            elseif ($productName == 'Oberflächendesinfektionsmittel 1Liter'){
//                $product->flachendes = 'FLÄCHENDES.';
//            }
//            elseif ($productName == 'Spender für Handdesinfektion'){
//                $product->handSpender = 'HAND SPENDER';
//            }
//            elseif ($productName == 'Flip Flop Deutschland'){
//                $product->germany = 'DEUTSCHLAND';
//            }
//            elseif ($productName == 'Flip Flop Schweiz'){
//                $product->switzerland = 'SCHWEIZ';
//            }
//            elseif ($productName == 'Flip Flop Italien'){
//                $product->italy = 'ITALIEN';
//            }
//            elseif ($productName == 'Flip Flop Frankreich'){
//                $product->france = 'FRANKREICH';
//            }
//            elseif ($productName == 'Flip Flop Niederlande'){
//                $product->netherlands = 'NIEDERLANDE';
//            }
//            elseif ($productName == 'Flip Flop Spanien'){
//                $product->spain = 'SPANIEN';
//            }
//            elseif ($productName == 'Flip Flop England'){
//                $product->england = 'ENGLAND';
//            }
//            elseif ($productName == 'Flip Flop Österreich'){
//                $product->austria = 'ÖSTERREICH';
//            }
//            elseif ($productName == 'Flip Flop Portugal'){
//                $product->portugal = 'PORTUGAL';
//            }
//        }
//        return $product;
//    }
