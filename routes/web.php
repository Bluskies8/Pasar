<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HtransController;
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


Route::get('tologin', function () {
    return view('pages/login');
});
// Route::get('stock', function () {
//     return view('pages/stock');
// });
// Route::get('details', function () {
//     return view('pages/stockDetail');
// });
Route::post('login',[DashboardController::class,'login']);
Route::middleware(['checkLogin','checkshif'])->group(function () {
    Route::get('/', function () {
        return view('pages/dashboard');
    });
    Route::get('stock', [HtransController::class,'index']);
    Route::get('details', [HtransController::class,'detailspage']);
    Route::get('details/{htrans}', [HtransController::class,'details']);
    Route::prefix('transaction')->group(function () {
        Route::post('create',[HtransController::class,'store'])->middleware('role:3');
        Route::post('delete/{htrans:id}',[HtransController::class,'destroy'])->middleware('role:2');
    });
});
