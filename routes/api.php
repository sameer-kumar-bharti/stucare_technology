<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/add_company',[ApiController::class,'add_new_company']);
Route::post('/update_company',[ApiController::class,'update_company']);
Route::get('/delete_company/{id}',[ApiController::class,'delete_company']);
Route::get('/getdata',[ApiController::class,'getdata']);