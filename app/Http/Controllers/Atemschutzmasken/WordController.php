<?php

namespace App\Http\Controllers\Atemschutzmasken;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\AtemschutzmaskenClasses\WordService;

class WordController extends Controller
{
    public function generateManWord($id, $project_id){
        $order = Order::findOrFail($id);
        $fileName = WordService::generateManDoc($order, $project_id);
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }

  
    public function generateWomanWord($id, $project_id){
        $order = Order::findOrFail($id);
        $fileName = WordService::generateWomanDoc($order, $project_id);
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
}
