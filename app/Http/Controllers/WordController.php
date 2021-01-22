<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WordController extends Controller
{
    public function generateWord($id, $project_id, $customer_id){

        $order = Order::where(['project_id' => $project_id])->findOrFail($id);
        $fileName = Word::generateDoc($order, $project_id, $customer_id);
        return response()->download( 'invoices/'. $fileName . '.docx')->deleteFileAfterSend(true);
    }

    public function exportWord(Request $request){

        $id = 2220;
        $project_id = 1;
        $customer_id = 'man';

        $order = Order::where(['project_id' => $project_id])->findOrFail($id);
        $file = Word::generateDoc($order, $project_id, $customer_id);
        $file_path = public_path("invoices/" . $file . '.docx');

        return redirect()->back();







    }

}
