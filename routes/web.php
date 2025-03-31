<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\Auth\LoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/user/{identifier}', [QRCodeController::class, 'showUserByQr'])->name('qr.show');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [QRCodeController::class, 'index'])->name('qr.index');

    Route::post('/qr/fetch-selected', [QRCodeController::class, 'fetchSelectedForPrint'])->name('qr.fetch.selected');

    Route::post('/qr-code/mark-printed', [App\Http\Controllers\QRCodeController::class, 'markAsPrinted'])
        ->name('qr.markAsPrinted');
});


Route::put('/users/{id}', [QRCodeController::class, 'update'])->name('users.update');
