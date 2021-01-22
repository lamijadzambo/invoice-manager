<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function generateWord($id, $project_id, $customer_id){
        $order = Order::findOrFail($id);
        $fileName = Word::generateDoc($order, $project_id, $customer_id);
        return response()->download( 'invoices/'. $fileName . '.docx')->deleteFileAfterSend(true);
    }

    public function exportWord($project_id){
        $orders = Order::where('project_id', $project_id)->get();
        foreach($orders as $order){
            Word::generateDoc($order, $project_id, 'MAN');
        }
        return redirect()->back();
    }

}
