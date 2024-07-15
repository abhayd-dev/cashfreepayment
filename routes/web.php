<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashfreePaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|

|
*/
// Route::get('/', function(){
//     return view('welcome');
// });

Route::get('/', [CashfreePaymentController::class, 'create'])->name('callback');
Route::post('cashfree/payments/store', [CashfreePaymentController::class, 'store'])->name('store');
Route::get('/cashfree/payments/success', [CashfreePaymentController::class, 'success'])->name('cashfree.success');
Route::get('/cashfree/payments/failure', [CashfreePaymentController::class, 'failure'])->name('cashfree.failure');

Route::get('show-table', [CashfreePaymentController::class, 'showTable'])->name('show-table');
Route::post('/cashfree/cancel', [CashfreePaymentController::class,'cancel']);

