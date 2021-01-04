<?php

namespace App\Http\Controllers\Atemschutzmasken;

//use App\Imports\BulkImport;

use App\AtemschutzmaskenClasses\Product;
use App\AtemschutzmaskenClasses\OrderTransformer;
use App\AtemschutzmaskenClasses\OrderService;
use App\AtemschutzmaskenClasses\ProductAttributesService;
use App\AtemschutzmaskenClasses\ExcelService;
use App\AtemschutzmaskenClasses\ProductService;
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

        $savedOrder = OrderTransformer::save($allOrders, $project_id);
        $productName = (new ProductService)->fetchProductNames($project_id);

        return view('filtered.index', compact('savedOrder', 'project_id', 'productName'));
    }

    public function exportOrdersExcel(){
        return (new ExcelService())->download('Bestellungen.xlsx');
    }

    public function exportProductColorsExcel(){
        return (new ProductAttributesService())->download('Produktfarbe.xlsx');
    }
}
