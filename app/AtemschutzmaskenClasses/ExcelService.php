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

    public $id;
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
            '' => $headerHg001 ?: $germany,
            $headerTypII ? $headerTypII : $switzerland,
            $headerTypIIR ? $headerTypIIR : $italy,
            $headerHg002 ? $headerHg002 : $france,
            $headerHg005 ? $headerHg005 : $netherlands,
            $headerRedMask ? $headerRedMask : $spain,
            $headerDoorHandler ? $headerDoorHandler : $england,
            $headerMedEinweg ? $headerMedEinweg : $austria,
            $headerStoff ? $headerStoff : $portugal,
            $headerTrennwand ? $headerTrennwand : '',
            $headerThermometer ? $headerThermometer : '',
            $headerHanddesinf ? $headerHanddesinf : '',
            $headerFlachendes ? $headerFlachendes : '',
            $headerHandSpender ? $headerHandSpender : '',
            'Betrag'
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

        $id = $this->id;
        $dbOrders = Order::where('project_id', $id)->get();
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
                    'hyg_hg_001'            => $order->hg001 ?: $order->germany,
                    'typII'                 => $order->typII ?: $order->switzerland,
                    'typIIR'                => $order->typIIR ?: $order->italy,
                    'hg002'                 => $order->hg002 ?: $order->france,
                    'hg005'                 => $order->hg005 ?: $order->netherlands,
                    'redMask'               => $order->redMask ?: $order->spain,
                    'doorHandler'           => $order->doorHandler ?: $order->england,
                    'medEinweg'             => $order->medEinweg ?: $order->austria,
                    'stoff'                 => $order->stoff ?: $order->portugal,
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
