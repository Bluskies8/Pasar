<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HtransController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

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


Route::get('login', function () {
    return view('pages/login');
});
Route::post('clogin',[DashboardController::class,'login']);

// Route::middleware(['checkLogin','checkshif'])->group(function () {
Route::middleware(['checkLogin'])->group(function () {
    Route::get('/', function () {
        return view('pages.dashboard');
    });
    Route::prefix('invoice')->group(function () {
        Route::get('/',[invoicecontroller::class,'invoice'])->middleware('role:2,3');
        Route::get('/generate', [InvoiceController::class,'generate'])->middleware('role:2');
        Route::get('/update', [InvoiceController::class,'update'])->middleware('role:2');
        Route::get('/{id}', [InvoiceController::class,'invoicedetails'])->middleware('role:2,3');
    });
    Route::get('stock', [HtransController::class,'index']);
    Route::prefix('details')->group(function () {
        Route::get('/', [HtransController::class,'detailspage']);
        Route::get('/{htrans}', [HtransController::class,'details']);
    });
    Route::prefix('transaction')->group(function () {
        Route::post('create',[HtransController::class,'store'])->middleware('role:4');
        Route::post('delete/{htrans:id}',[HtransController::class,'destroy'])->middleware('role:3');
    });
    Route::prefix('vendor')->middleware('role:2')->group(function () {
        Route::get('/',[DashboardController::class,'vendor']);
        Route::get('/update',[DashboardController::class,'vendorUpdate']);
    });
});

// view vendor
