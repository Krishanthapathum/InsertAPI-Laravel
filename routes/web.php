<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRCodeController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/qr', [QRCodeController::class, 'index'])->name('qr.index');
Route::post('/qr/generate', [QRCodeController::class, 'generate'])->name('qr.generate');

// web.php
Route::get('/user/{identifier}', [QRCodeController::class, 'showUserByQr'])->name('qr.show');

