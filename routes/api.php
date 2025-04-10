<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermitUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/test', function () {
//     return response()->json(['message' => 'API working']);
// });


// Route::post('/store-user', [PermitUserController::class, 'store']);
Route::middleware('auth.apikey')->post('/store-user', [PermitUserController::class, 'store']);


Route::get('/user-by-permit/{int_permit_no}', [PermitUserController::class, 'findByPermit']);

// Route::middleware(['auth:sanctum'])->get('/user-by-permit/{int_permit_no}', [PermitUserController::class, 'findByPermit']);

