<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class WordController extends Controller
{
    public function generateWord($id, $project_id, $customer_id){

        $order = Order::where(['project_id' => $project_id])->findOrFail($id);
        $fileName = Word::generateDoc($order, $project_id, $customer_id);
        return response()->download( 'invoices/'. $fileName . '.docx')->deleteFileAfterSend(true);
    }

    public function exportWord($id, $project_id, $customer_id, Request $request){

        $order = Order::where(['project_id' => $project_id])->findOrFail($id);
        $fileName = Word::generateDoc($order, $project_id, $customer_id);
        Storage::disk('google')->put( $fileName . '.docx', File::get('invoices/'. $fileName . '.docx'));
        if(File::exists(public_path('invoices/'. $fileName . '.docx'))){
            File::delete(public_path('invoices/'. $fileName . '.docx'));
            $request->session()->flash('success', 'The order has been exported to Google Drive');
        }else{
            $request->session()->flash('info', 'The file does not exist.');
        }
        return redirect()->back();
    }

}
