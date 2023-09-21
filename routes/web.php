<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\StripeChargeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('login',[CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration']);
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

// Stripe Charge
Route::get('products', [StripeChargeController::class, 'index'])->name('products');
Route::get('paymentPage', [StripeChargeController::class, 'paymentPage'])->name('paymentPage');
Route::get('/payment/{string}/{price}', [StripeChargeController::class, 'charge'])->name('goToPayment');
Route::post('payment/process-payment/{string}/{price}', [StripeChargeController::class, 'processPayment'])->name('processPayment');