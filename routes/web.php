<?php

use App\Http\Controllers\Atemschutzmasken\ExcelController;
use App\Http\Controllers\Atemschutzmasken\OrderController;
use App\Http\Controllers\Atemschutzmasken\PDFController;
use App\Http\Controllers\Atemschutzmasken\WordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GoogleOrdersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//GOOGLE SHEET
//Route::get('google-sheet', function (){ return view('welcome'); });
//Route::get('google-sheet-invoke', HomeController::class);
//Route::post('/google-sheet-post', [GoogleOrdersController::class])->name('google-spreadsheet');

Auth::routes(['register' => false]);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/projects', [ProjectController::class, 'showProjects'])->name('projects');
    Route::get('/index/{id}', [OrderController::class, 'index'])->name('index');
    Route::get('/orders', [OrderController::class, 'get'])->name('get.orders');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('show.order');
    Route::delete('/order/{id}', [OrderController::class, 'delete'])->name('delete.order');
    // SELECT IF ORDER PRINTED OUT
    Route::get('/order-status/{id}', [OrderController::class, 'setStatus'])->name('set-status.order');

    // EXCEL EXPORT
    Route::get('/index/filtered', [ExcelController::class, 'index'])->name('excel.index');
    Route::get('/export', [ExcelController::class, 'exportOrdersExcel'])->name('excel-export');
    Route::get('/export-color', [ExcelController::class, 'exportProductColorsExcel'])->name('color-table-export');
    //Route::get('importExportView', [ImportExportController::class, 'importExportView']);
    //Route::post('import', [ImportExportController::class, 'import'])->name('import');

    // PDF EXPORT
    Route::get('/generate-man-pdf/{id}', [PDFController::class, 'generateManPdf'])->name('generate-man-pdf');
    Route::get('/generate-woman-pdf/{id}', [PDFController::class, 'generateWomanPdf'])->name('generate-woman-pdf');

    // WORD EXPORT
    Route::get('/generate-man-docx/{id}', [WordController::class, 'generateManWord'])->name('generate-man-doc');
    Route::get('/generate-woman-docx/{id}', [WordController::class, 'generateWomanWord'])->name('generate-woman-doc');

//    Route::get('/google-sheet-post', function(){ (new GoogleOrdersController())->__invoke(); })->name('google-spreadsheet');

    // SAVE FILE IN GOOGLE CLOUD (HARD CODED)
//    Route::get('/test', function () {
//        Storage::disk('google')->put('Test.txt', 'Emir');
//        return redirect()->route('index');
//    });

    // FORM FOR UPLOADING FILE IN GOOGLE FOLDER
//    Route::get('/add-file', function (){
//        return view('google.google-drive');
//    })->name('upload-file');

    // UPLOAD FILE IN A NESTED GOOGLE DRIVE FOLDER
//    Route::post('/upload', function (Request $request){
//        $request->file('thing')->store(env('GOOGLE_DRIVE_NESTED_FOLDER_ID'), 'google');
//        //$request->file('thing')->store('', 'google'); // google drive folder specified in .env
//        return redirect()->route('index');
//    });

//    Route::get('/download', function(){
//        $item = 'Laravel.txt';
//        $file = Storage::disk('google')->url($item['https://drive.google.com/drive/u/0/my-drive']);
//        return $file;
//    });

});
























