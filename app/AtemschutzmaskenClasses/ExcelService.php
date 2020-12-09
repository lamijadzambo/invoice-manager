<?php


namespace App\AtemschutzmaskenClasses;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ExcelService implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
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




    public function collection()
    {
        return Order::all('billing_company', 'billing_last_name', 'billing_first_name', 'item', 'billing_email',
        'billing_phone', 'id', 'order_status', 'hyg_hg001', 'typ_II', 'typ_IIR', 'n95_hg002', 'schild_hg005', 'hyg_red_masks',
        'door_handler', 'med_einweg', 'stoffmasken', 'trennwand', 'thermometer', 'hand_disinfection', 'flachendes', 'hand_spender',
        'order_total_amount');
    }

}
