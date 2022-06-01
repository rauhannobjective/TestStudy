<?php

use App\Http\Controllers\Cart\AddProductController;
use App\Http\Controllers\Cart\CalculeTotalValueController;
use App\Http\Controllers\Cart\RemoveProductController;
use Illuminate\Support\Facades\Route;

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

Route::patch('add-product/{cartId}', AddProductController::class);
Route::patch('remove-product/{cartId}', RemoveProductController::class);
Route::post('total/{cartId}', CalculeTotalValueController::class);
