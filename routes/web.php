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

Route::get('/', function () {
    return view('dashboard');
});
Route::get('tologin', function () {
    return view('login');
});
Route::get('totrans', function () {
    return view('transaction');
});
Route::get('stock', function () {
    return view('stock');
});
Route::post('login',[DashboardController::class,'login']);
Route::middleware(['checkLogin','checkshif'])->group(function () {
    Route::prefix('transaction')->group(function () {
        Route::post('create',[HtransController::class,'store'])->middleware('role:3');
    });
});
