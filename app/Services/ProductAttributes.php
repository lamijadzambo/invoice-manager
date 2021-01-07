<?php

namespace App\Services;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductAttributes implements FromArray, WithHeadings, WithStyles, WithColumnWidths
{
    use Exportable;


    public function headings(): array
    {
        return [
            'Kunde',
            'Navy',
            'Orange',
            'Charcoal',
            'Schwarz',
            'Weiss',
            'OrderModel number',
        ];
    }


    public function columnWidths(): array
    {
        return [
            'A' => 30,
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
            // Styling a specific cell by coordinate.
            //'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            //'C'  => ['font' => ['size' => 16]],
        ];
    }


    public function array(): array{

        $orders = Order::all();

        foreach($orders as $order){
            $products = json_decode($order->products);
            $black = ''; $charcoal = ''; $white = ''; $navy = ''; $orange = '';

            foreach ($products as $product){
                    if($product->sku == '009AM'){

                        $color = $product->meta_data[0]->value;

                        if ($color === 'schwarz') {
                            $black = $product->quantity;
                        }
                        if ($color === 'charcoal') {
                            $charcoal = $product->quantity;
                        }
                        if ($color === 'weiss') {
                            $white = $product->quantity;
                        }
                        if ($color === 'navy') {
                            $navy = $product->quantity;
                        }
                        if ($color === 'orange') {
                            $orange = $product->quantity;
                        }
                }
            }


            $formattedOrderProductColors = array(
                'first_name'            => $order->billing_first_name . ' ' . $order->billing_last_name,
                'qty_color_navy'        => $navy,
                'qty_color_orange'      => $orange,
                'qty_color_charcoal'    => $charcoal,
                'qty_color_black'       => $black,
                'qty_color_white'       => $white,
                'order_id'              => $order->id
            );

            $colorExportData[] = $formattedOrderProductColors;
        }
        return $colorExportData;
    }
}

