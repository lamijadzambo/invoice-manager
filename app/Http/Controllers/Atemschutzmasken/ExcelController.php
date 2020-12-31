<?php

namespace App\Http\Controllers\Atemschutzmasken;

use App\AtemschutzmaskenClasses\AttributesService;

//use App\Imports\BulkImport;
use App\AtemschutzmaskenClasses\OrderExecutor;
use App\AtemschutzmaskenClasses\OrderService;
use App\AtemschutzmaskenClasses\ProductAttributesService;
use App\AtemschutzmaskenClasses\ExcelService;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\ApplicationRepositoryInterface;
use Automattic\WooCommerce\Client;


class ExcelController extends Controller
{
    private $orderRepository;

    public function __construct(ApplicationRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index($project_id)
    {
        $allOrders = Order::where('project_id', $project_id)->get();

        $savedOrder = OrderExecutor::save($allOrders, $project_id);

        return view('filtered.index', compact('project_id', 'savedOrder'));
    }

    public function exportOrdersExcel(){
        return (new ExcelService())->download('Bestellungen.xlsx');
    }

    public function exportProductColorsExcel(){
        return (new ProductAttributesService())->download('Produktfarbe.xlsx');
    }
}
