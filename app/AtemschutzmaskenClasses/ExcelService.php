<?php

namespace App\AtemschutzmaskenClasses;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExcelService implements WithHeadings, WithStyles, WithColumnWidths
{
    use Exportable;

    public function headings(): array
    {
        return [
            'Firma',
            'Name',
            'Forname',
            '',
            'Email',
            'Telefon',
            'Bestell No.',
            'Status',
            'HYG HG-001',
            'Typ II',
            'Typ IIR',
            'N95 HG-002',
            'HYG Rote Masken',
            'Doorhandler',
            'Med. Einweg',
            'Stoffmasken',
            'Trefnnwand',
            'Thermometer',
            'Handdesinf.',
            'Flachendes',
            'Hand Spender',
            'Betrag',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true, 'size' => 16] ],
        ];
    }

    public function array(): array{

        $dbOrders = Order::all();
        $orders = OrderTransformer::save($dbOrders);

        foreach($orders as $order){
            $formattedOrderProductColors = array(
                'company'               => $order->billing_company,
                'name'                  => $order->billing_first_name,
                'surname'               => $order->billing_last_name,
                'email'                 => $order->billing_email,
                'phone'                 => $order->billing_phone,
                'orderNumber'           => $order->id,
                'status'                => $order->order_status,
                'hyg_hg_001'            => '',
                'typII'                 => $order->typII,
                'typIIR'                 => $order->typIIR
            );
            $colorExportData[] = $formattedOrderProductColors;
        }
        return $colorExportData;
    }
}
