<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function generateWord($id, $project_id, $customer_id){

        $order = Order::where(['project_id' => $project_id])->findOrFail($id);
        $fileName = Word::generateDoc($order, $project_id, $customer_id);
        return response()->download( 'invoices/'. $fileName . '.docx')->deleteFileAfterSend(true);
    }

    public function exportWord($id, $project_id, $customer_id){
        $order = Order::where(['project_id' => $project_id])->findOrFail($id);
        Word::generateDoc($order, $project_id, $customer_id);
        return redirect()->back();
    }

}
