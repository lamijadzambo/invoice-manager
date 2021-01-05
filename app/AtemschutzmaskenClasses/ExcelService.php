<?php


namespace App\AtemschutzmaskenClasses;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ExcelService implements FromArray, WithHeadings, WithStyles, WithColumnWidths
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
            'SHILD HG-005',
            'HYG Rote Masken',
            'Doorhandler',
            'Med. Einweg',
            'Stoffmasken',
            'Trennwand',
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

        $orders = OrderTransformer::transformOrder($dbOrders);

        foreach($orders as $order){
            $formattedOrderProductColors = array(
                'company'               => $order->billing_company,
                'name'                  => $order->billing_first_name,
                'surname'               => $order->billing_last_name,
                'emptyColumn'           => '',
                'email'                 => $order->billing_email,
                'phone'                 => $order->billing_phone,
                'orderNumber'           => $order->id,
                'status'                => $order->order_status,
                'hyg_hg_001'            => $order->hg001,
                'typII'                 => $order->typII,
                'typIIR'                => $order->typIIR,
                'hg002'                 => $order->hg002,
                'hg005'                 => $order->hg005,
                'redMask'               => $order->redMask,
                'doorHandler'           => $order->doorHandler,
                'medEinweg'             => $order->medEinweg,
                'stoff'                 => $order->stoff,
                'trennwand'             => $order->trennwand,
                'thermometer'           => $order->thermometer,
                'handDesif'             => $order->handSmilsan,
                'flachendes'            => $order->flachendes,
                'handSpender'           => $order->handSpender,
                'betrag'                => $order->order_total_amount,
            );

            $colorExportData[] = $formattedOrderProductColors;
        }

        return $colorExportData;
    }

}
