<?php

namespace App\Http\Controllers\Atemschutzmasken;

use App\AtemschutzmaskenClasses\AttributesService;

//use App\Imports\BulkImport;
use App\AtemschutzmaskenClasses\ProductAttributesService;
use App\AtemschutzmaskenClasses\ExcelService;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\ApplicationRepositoryInterface;

class ExcelController extends Controller
{
    private $orderRepository;

    public function __construct(ApplicationRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $allOrders = Order::all();
        return view('filtered.index', compact('allOrders'));
    }

    public function exportOrdersExcel(){
        return (new ExcelService())->download('Bestellungen.xlsx');
    }

    public function exportProductColorsExcel(){
        return (new ProductAttributesService())->download('Produktfarbe.xlsx');
    }
}
