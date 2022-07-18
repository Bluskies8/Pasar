<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HtransController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RetribusiController;
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
Route::get('logout',[DashboardController::class,'logout']);

// Route::middleware(['checkLogin','checkshif'])->group(function () {
Route::middleware(['checkLogin'])->group(function () {
    Route::get('/', [DashboardController::class,'dashboard']);

    Route::prefix('user')->group(function () {
        Route::get('/',[DashboardController::class,'userPages']);
        Route::post('/create',[DashboardController::class,'createUser']);
        Route::post('/update/{user:id}',[DashboardController::class,'updateUser']);
        Route::post('/delete/{user:id}',[DashboardController::class,'deleteUser']);
    });
    Route::prefix('retribusi')->group(function () {
        Route::get('/', [RetribusiController::class,'index']);
        Route::post('/getretri', [RetribusiController::class,'getRetri']);
        Route::post('/create', [RetribusiController::class,'store']);

    });
    Route::prefix('invoice')->group(function () {
        Route::get('/',[invoicecontroller::class,'invoice']);
        Route::get('/generate', [InvoiceController::class,'generate']);//->middleware('role:2');
        Route::post('/update', [InvoiceController::class,'update']);//->middleware('role:2');
        Route::post('/transdetail', [InvoiceController::class,'transactionDetails']);//->middleware('role:2');
        Route::get('/{id}', [InvoiceController::class,'invoicedetails']);
    });
    Route::get('stock', [HtransController::class,'index']);
    Route::prefix('details')->group(function () {
        Route::get('/', [HtransController::class,'detailspage']);
        Route::get('/{htrans}', [HtransController::class,'details']);
    });
    Route::prefix('transaction')->group(function () {
        Route::post('create',[HtransController::class,'store']);//->middleware('role:4');
        Route::post('delete/{htrans:id}',[HtransController::class,'destroy']);//->middleware('role:3');
    });
    Route::prefix('vendor')->group(function () {
        Route::get('/',[DashboardController::class,'vendor']);
        Route::post('/update',[DashboardController::class,'vendorUpdate']);
    });
});
