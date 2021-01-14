<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {

        return redirect()->route('projects');
    }

    // Google spreadsheet
    public function __invoke(Request $request)
    {
//        $sheets = Sheets::spreadsheet(config('sheets.post_spreadsheet_id'))
//
//            ->sheet(config('sheets.post_sheet_id'))
//
//            ->get();

        $sheets = Sheets::spreadsheet(config('sheets.post_spreadsheet_id'))

            ->sheetById(config('sheets.post_sheet_id'))

            ->all();

        $header = [
            'Firma',
            'Name',
            'Vorname',
            'Empty',
            'E-mail',
            'Telefon',
            'Bestell No.',
            'Status',
            'Hyg HG-001',
            'Typ II',
            'Typ IIR',
            'N95 HG-002',
            'Shild HG-005',
            'Hyg rote Masken',
            'Doorhandler',
            'Med. Einweg',
            'Stoffmasken',
            'Trennwand',
            'Thermometer',
            'Handdesinf.',
            'Flächendes.',
            'Hand Spender',
            'Betrag'
        ];

        $posts = Sheets::collection($header, $sheets);

        $posts = $posts->reverse()->take(10);

        return view('welcome')->with(compact('posts'));
    }
}
