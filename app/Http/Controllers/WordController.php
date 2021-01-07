<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Word;

class WordController extends Controller
{
    public function generateWord($id, $project_id, $customer_id){
        $order = Order::findOrFail($id);
        $fileName = Word::generateDoc($order, $project_id, $customer_id);
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
}
