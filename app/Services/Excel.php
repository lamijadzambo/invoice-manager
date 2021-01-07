<?php

namespace App\Services;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Excel implements FromArray, WithHeadings, WithStyles, WithColumnWidths
{
    use Exportable;

    protected $id;
    public function __construct ($project_id){
        $this->id = $project_id;
    }

    public function headings(): array
    {
        $id = $this->id;

        if($id == 1){
            $headerHg001 = 'HYG HG-001';
            $headerTypII = 'Typ II';
            $headerTypIIR = 'Typ IIR';
            $headerHg002 = 'N95 HG-002';
            $headerHg005 = 'SHILD HG-005';
            $headerRedMask = 'HYG Rote Masken';
            $headerDoorHandler = 'Doorhandler';
            $headerMedEinweg = 'Med. Einweg';
            $headerStoff = 'Stoffmasken';
            $headerTrennwand = 'Trennwand';
            $headerThermometer = 'Thermometer';
            $headerHanddesinf = 'Handdesinf.';
            $headerFlachendes = 'Flachendes';
            $headerHandSpender = 'Hand Spender';
        }elseif($id == 2){
            $switzerland = 'Switzerland';
            $germany = 'Germany';
            $italy = 'Italy';
            $france = 'France';
            $netherlands = 'Netherlands';
            $spain = 'Spain';
            $england = 'England';
            $austria = 'Austria';
            $portugal = 'Portugal';
            $columnLimit = '';
        }

        return [
            'Firma',
            'Name',
            'Forname',
            '',
            'Email',
            'Telefon',
            'Bestell No.',
            'Status',
            isset($headerHg001) ? $headerHg001 : $germany,
            isset($headerTypII) ? $headerTypII : $switzerland,
            isset($headerTypIIR) ? $headerTypIIR : $italy,
            isset($headerHg002) ? $headerHg002 : $france,
            isset($headerHg005) ? $headerHg005 : $netherlands,
            isset($headerRedMask) ? $headerRedMask : $spain,
            isset($headerDoorHandler) ? $headerDoorHandler : $england,
            isset($headerMedEinweg) ? $headerMedEinweg : $austria,
            isset($headerStoff) ? $headerStoff : $portugal,
            isset($headerTrennwand) ? $headerTrennwand : 'Betrag',
            isset($headerThermometer) ? $headerThermometer : '',
            isset($headerHanddesinf) ? $headerHanddesinf : '',
            isset($headerFlachendes) ? $headerFlachendes : '',
            isset($headerHandSpender) ? $headerHandSpender : '',
            isset($columnLimit) ? '' : 'Betrag',
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
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 20,
            'M' => 20,
            'N' => 20,
            'O' => 20,
            'P' => 20,
            'Q' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true, 'size' => 16] ],
        ];
    }

    public function array(): array{

        $id = $this->id;
        $dbOrders = Order::where('project_id', $id)->get();
        $orders = OrderTransformer::transformOrder($dbOrders);

        // FlipFlop orders ($id=2) have fewer columns; $columnLimit used to avoid empty columns
        if($id == 2){
            $columnLimit = '';
        }
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
                    'hyg_hg_001'            => $order->hg001 ?: $order->germany,
                    'typII'                 => $order->typII ?: $order->switzerland,
                    'typIIR'                => $order->typIIR ?: $order->italy,
                    'hg002'                 => $order->hg002 ?: $order->france,
                    'hg005'                 => $order->hg005 ?: $order->netherlands,
                    'redMask'               => $order->redMask ?: $order->spain,
                    'doorHandler'           => $order->doorHandler ?: $order->england,
                    'medEinweg'             => $order->medEinweg ?: $order->austria,
                    'stoff'                 => $order->stoff ?: $order->portugal,
                    'trennwand'             => isset($columnLimit) ? $order->order_total_amount : $order->trennwand,
                    'thermometer'           => $order->thermometer,
                    'handDesif'             => $order->handsmittel,
                    'flachendes'            => $order->flachendes,
                    'handSpender'           => $order->handSpender,
                    'betrag'                => isset($columnLimit) ? $columnLimit : $order->order_total_amount,
                );

            $colorExportData[] = $formattedOrderProductColors;
        }
        return $colorExportData;
    }

}
