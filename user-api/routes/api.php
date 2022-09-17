<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

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

// Get All Customers
Route::get('/customers', [CustomerController::class, 'index']);

// Get one Customer
Route::get('/customers/{id}', [CustomerController::class, 'show']);

// Add Customer
Route::post('/customers', [CustomerController::class, 'store']);

// Update Customer
Route::put('/customers/{id}', [CustomerController::class, 'update']);

// Delete Customer
Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

// Search Customer
Route::get('/customers/search/{name}', [CustomerController::class, 'search']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
