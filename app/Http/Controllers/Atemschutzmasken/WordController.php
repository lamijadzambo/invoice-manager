<?php

namespace App\Http\Controllers\Atemschutzmasken;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\AtemschutzmaskenClasses\WordService;

class WordController extends Controller
{
    public function generateManWord($id){
        $order = Order::findOrFail($id);
        $fileName = (new WordService())->generateManDoc($order);
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }

    public function generateWomanWord($id){
        $order = Order::findOrFail($id);
        $fileName = (new WordService())->generateWomanDoc($order);
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
}
