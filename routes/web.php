<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\GoogleOrdersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Auth::routes(['register' => false]);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');

Route::group(['middleware' => 'auth'], function () {

    // SELECT SHOP
    Route::get('/projects', [ProjectController::class, 'showProjects'])->name('projects');
    Route::get('/index/{project_id}', [OrderController::class, 'index'])->name('index');

    // CRUD ORDER
    Route::get('/orders/{project_id}', [OrderController::class, 'get'])->name('get.orders');
    Route::get('/order/{project_id}/show/{id}/', [OrderController::class, 'show'])->name('show.order');
    Route::delete('/order/{id}', [OrderController::class, 'delete'])->name('delete.order');

    Route::get('/order-status/{id}', [OrderController::class, 'setStatus'])->name('set-status.order');

    // IMPORT AND EXPORT OF ORDERS
    Route::get('/index/filtered/{project_id}', [ExcelController::class, 'index'])->name('excel.index');
    Route::get('/export/{project_id}', [ExcelController::class, 'exportOrdersExcel'])->name('excel-export');
    Route::get('/export-color/{project_id}', [ExcelController::class, 'exportProductColorsExcel'])->name('color-table-export');
    Route::get('/generate-pdf/{id}/{project_id}/{customer_id}', [PDFController::class, 'generatePdf'])->name('generate-pdf');
    Route::get('/generate-docx/{id}/{project_id}/{customer_id}', [WordController::class, 'generateWord'])->name('generate-doc');
    //Route::get('importExportView', [ImportExportController::class, 'importExportView']);
    //Route::post('import', [ImportExportController::class, 'import'])->name('import');




//GOOGLE SHEET
//Route::get('google-sheet', function (){ return view('welcome'); });
//Route::get('google-sheet-invoke', HomeController::class);
//Route::post('/google-sheet-post', [GoogleOrdersController::class])->name('google-spreadsheet');

    Route::get('/google-sheet-post/{project_id}', [GoogleOrdersController::class, '__invoke'])->name('google-spreadsheet');
    Route::get('/export-invoices/{project_id}', [WordController::class, 'exportWord'])->name('export-invoices');

    // SAVE FILE IN GOOGLE CLOUD (HARD CODED)
    Route::get('/test', function () {
        Storage::disk('google')->put('Test.txt', 'Emir');
        return redirect()->route('index');
    });

    // FORM FOR UPLOADING FILE IN GOOGLE FOLDER
    Route::get('/add-file', function (){
        return view('google.google-drive');
    })->name('upload-file');

    // UPLOAD FILE IN A NESTED GOOGLE DRIVE FOLDER
    Route::post('/upload', function (Request $request){
        $request->file('thing')->store(env('GOOGLE_DRIVE_NESTED_FOLDER_ID'), 'google');
        //$request->file('thing')->store('', 'google'); // google drive folder specified in .env

        return redirect()->route('get.orders');
    });

//    Route::get('/download', function(){
//        $item = 'Laravel.txt';
//        $file = Storage::disk('google')->url($item['https://drive.google.com/drive/u/0/my-drive']);
//        return $file;
//    });

});
