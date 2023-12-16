<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\EmployeesController;
use App\Http\Controllers\api\SalesController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\api\ToDoListController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user()->accessTokens()->get();
});

Route::group(['middleware' => ['cors', 'json.response']], function () {
    // public routes
    // Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    // Route::post('/register','Auth\ApiAuthController@register')->name('register.api');
    Route::post('register',[ApiAuthController::class, 'register'])->name('register.api');
    Route::post('login',[ApiAuthController::class, 'login'])->name('login.api');
});

Route::middleware('auth:api')->group(function () {
    // Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
    Route::post('logout',[ApiAuthController::class, 'logout'])->name('logout.api');
    Route::get('authorization',[ApiAuthController::class, 'authorization'])->name('authorization.api');


});

Route::apiResource('employees', EmployeesController::class);
Route::apiResource('sales', SalesController::class);
Route::apiresource('todos', ToDoListController::class);
