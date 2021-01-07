<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade as PDF;

class PDFController extends Controller
{
    public function generatePdf($id, $project_id, $customer_id)
    {
        $order = Order::findOrFail($id);
        $pdf = PDF::loadView('pdf-templates/pdforder', ['order' => $order, 'project_id' => $project_id, 'customer_id' => $customer_id]);
        return $pdf->download($order['shipping_first_name'] . '_' . $order['shipping_last_name'] . '.pdf');
    }
}
