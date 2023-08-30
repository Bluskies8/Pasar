<?php

use App\Http\Controllers\BuahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HtransController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ListrikController;
use App\Http\Controllers\RetribusiController;
use App\Http\Controllers\TransportasiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

// if(env('APP_ENV') === "production") {
//     URL::forceScheme('https');
// }

Route::get('/', function () {
    return redirect('login');
});
Route::get('login', function () {
    return view('pages/login');
});
Route::post('clogin',[DashboardController::class,'login']);
Route::get('logout',[DashboardController::class,'logout']);

// Route::middleware(['checkLogin','checkshif'])->group(function () {
Route::middleware(['checkLogin'])->group(function () {
    Route::post('updatePassword',[DashboardController::class,'updatepassword']);

    Route::group(['middleware'=>'role','prefix'=>'superadmin'],function () {
        Route::get('/', [DashboardController::class,'dashboard']);
        Route::get('changePassword', function () {
            return view('pages/changePassword');
        });

        Route::get('switchPasar', [DashboardController::class,'switchpages']);
        Route::get('/switch/{id}',[DashboardController::class,'switchPasar']);
        Route::post('tambahPasar',[DashboardController::class,'tambahPasar']);
        Route::get('stock', [HtransController::class,'index']);
        Route::get('stockTable', [HtransController::class,'indexTable']);
        // Route::get('vendorTable', [DashboardController::class,'vendorTable']);
        // Route::get('/reset',[DashboardController::class,'reset']);
        Route::prefix('buah')->group(function () {
            Route::get('/',[BuahController::class,'index']);
            Route::get('/cari',[BuahController::class,'cari']);
            Route::post('/create',[BuahController::class,'store']);
            Route::post('/update/{buah:id}',[BuahController::class,'update']);
            Route::post('/delete/{buah:id}',[BuahController::class,'destroy']);
        });
        Route::prefix('listrik')->group(function () {
            Route::get('/',[ListrikController::class,'index']);
            Route::post('/create',[ListrikController::class,'store']);
            Route::post('/update/{listrik:id}',[ListrikController::class,'update']);
            Route::post('/delete/{listrik:id}',[ListrikController::class,'destroy']);
        });
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
            Route::get('/',[InvoiceController::class,'invoice']);
            Route::get('/generate/{idlapak}', [InvoiceController::class,'generate']);
            Route::post('/update', [InvoiceController::class,'update']);
            Route::post('/transdetail', [InvoiceController::class,'transactionDetails']);
            Route::get('/{id}', [InvoiceController::class,'invoicedetails']);
        });
        Route::prefix('details')->group(function () {
            Route::get('/', [HtransController::class,'detailspage']);
            Route::get('/update/{htrans:id}', [HtransController::class,'update']);
            Route::get('/{htrans}', [HtransController::class,'details']);
        });
        Route::prefix('transaction')->group(function () {
            Route::post('create',[HtransController::class,'store']);
            Route::post('delete/{htrans:id}',[HtransController::class,'destroy']);
        });
        Route::prefix('vendor')->group(function () {
            Route::get('/',[DashboardController::class,'vendor']);
            Route::get('/Table', [DashboardController::class,'vendorTable']);
            Route::post('/create',[DashboardController::class,'vendorCreate']);
            Route::post('/update',[DashboardController::class,'vendorUpdate']);
            Route::delete('/delete',[DashboardController::class,'vendorDelete']);
        });
        Route::prefix('transport')->group(function () {
            Route::get('/',[TransportasiController::class,'index']);
            Route::post('/create',[TransportasiController::class,'store']);
            Route::post('/update',[TransportasiController::class,'update']);
            Route::delete('/delete/{transportasi:id}',[TransportasiController::class,'destroy']);
        });

        Route::get('/invo',[invoicecontroller::class,'index']);
        Route::get('/logs',[DashboardController::class,'logs']);
    });
    Route::group(['middleware'=>'admin','prefix'=>'admin'],function () {
        Route::get('changePassword', function () {
            return view('pages/changePassword');
        });
        Route::get('stock', [HtransController::class,'index']);
        Route::get('stockTable', [HtransController::class,'indexTable']);
        Route::get('/', [DashboardController::class,'dashboard']);
        Route::prefix('buah')->group(function () {
            Route::get('/',[BuahController::class,'index']);
            Route::get('/cari',[BuahController::class,'cari']);
            Route::post('/create',[BuahController::class,'store']);
            Route::post('/update/{buah:id}',[BuahController::class,'update']);
            Route::post('/delete/{buah:id}',[BuahController::class,'destroy']);
        });
        Route::prefix('listrik')->group(function () {
            Route::get('/',[ListrikController::class,'index']);
            Route::post('/create',[ListrikController::class,'store']);
            Route::post('/update/{listrik:id}',[ListrikController::class,'update']);
            Route::post('/delete/{listrik:id}',[ListrikController::class,'destroy']);
        });
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
            Route::get('/generate/{idlapak}', [InvoiceController::class,'generate']);
            Route::post('/update', [InvoiceController::class,'update']);
            Route::post('/transdetail', [InvoiceController::class,'transactionDetails']);
            Route::get('/{id}', [InvoiceController::class,'invoicedetails']);
        });
        Route::prefix('details')->group(function () {
            Route::get('/', [HtransController::class,'detailspage']);
            Route::get('/update/{htrans:id}', [HtransController::class,'update']);
            Route::get('/{htrans}', [HtransController::class,'details']);
        });
        Route::prefix('transaction')->group(function () {
            Route::post('delete/{htrans:id}',[HtransController::class,'destroy']);
        });
        Route::prefix('vendor')->group(function () {
            Route::get('/',[DashboardController::class,'vendor']);
            Route::get('/Table', [DashboardController::class,'vendorTable']);
            Route::post('/create',[DashboardController::class,'vendorCreate']);
            Route::post('/update',[DashboardController::class,'vendorUpdate']);
        });
    });
    Route::group(['middleware'=>'kapten','prefix'=>'kapten'],function () {
        Route::get('changePassword', function () {
            return view('pages/changePassword');
        });
        Route::get('stock', [HtransController::class,'index']);
        Route::get('stockTable', [HtransController::class,'indexTable']);
        Route::prefix('buah')->group(function () {
            Route::get('/',[BuahController::class,'index']);
            Route::get('/cari',[BuahController::class,'cari']);
            Route::post('/create',[BuahController::class,'store']);
            Route::post('/update/{buah:id}',[BuahController::class,'update']);
            Route::post('/delete/{buah:id}',[BuahController::class,'destroy']);
        });
        Route::prefix('user')->group(function () {
            Route::get('/',[DashboardController::class,'userPages']);
            Route::post('/create',[DashboardController::class,'createUser']);
            Route::post('/update/{user:id}',[DashboardController::class,'updateUser']);
            Route::post('/delete/{user:id}',[DashboardController::class,'deleteUser']);
        });
        Route::prefix('invoice')->group(function () {
            Route::get('/',[invoicecontroller::class,'invoice']);
            Route::get('/generate/{idlapak}', [InvoiceController::class,'generate']);
            Route::post('/update', [InvoiceController::class,'update']);
            Route::post('/transdetail', [InvoiceController::class,'transactionDetails']);
            Route::get('/{id}', [InvoiceController::class,'invoicedetails']);
        });
        Route::prefix('details')->group(function () {
            Route::get('/', [HtransController::class,'detailspage']);
            Route::get('/update/{htrans:id}', [HtransController::class,'update']);
            Route::get('/{htrans}', [HtransController::class,'details']);
        });
        Route::prefix('transaction')->group(function () {
            Route::post('delete/{htrans:id}',[HtransController::class,'destroy']);
        });
    });
    Route::group(['middleware'=>'checker','prefix'=>'checker'],function () {
        Route::get('changePassword', function () {
            return view('pages/changePassword');
        });
        Route::get('stock', [HtransController::class,'index']);
        Route::get('stockTable', [HtransController::class,'indexTable']);
        Route::prefix('transaction')->group(function () {
            Route::post('create',[HtransController::class,'store']);
        });
        Route::get('/buah/cari',[BuahController::class,'cari']);
        Route::post('/user/update',[DashboardController::class,'updatepassword']);
        Route::prefix('invoice')->group(function () {
            Route::get('/',[invoicecontroller::class,'invoice']);
            Route::get('/generate/{idlapak}', [InvoiceController::class,'generate']);
            Route::post('/update', [InvoiceController::class,'update']);
            Route::post('/transdetail', [InvoiceController::class,'transactionDetails']);
            Route::get('/{id}', [InvoiceController::class,'invoicedetails']);
        });
        Route::prefix('details')->group(function () {
            Route::get('/', [HtransController::class,'detailspage']);
            Route::get('/{htrans}', [HtransController::class,'details']);
        });
    });
});
