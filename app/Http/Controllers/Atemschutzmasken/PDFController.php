<?php

namespace App\Http\Controllers\Atemschutzmasken;

use App\Models\Order;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;

class PDFController extends Controller
{
    public function generateManPdf($id, $project_id)
    {
        $order = Order::findOrFail($id);
        $pdf = PDF::loadView('pdf-templates/man', ['order' => $order, 'project_id' => $project_id]);
        return $pdf->download($order['shipping_first_name'] . '_' . $order['shipping_last_name'] . '.pdf');
    }

    public function generateWomanPdf($id, $project_id)
    {
        $order = Order::findOrFail($id);
        $pdf = PDF::loadView('pdf-templates/woman', ['order' => $order, 'project_id' => $project_id]);
        return $pdf->download($order['shipping_first_name'] . '_' . $order['shipping_last_name'] . '.pdf');
    }
}
