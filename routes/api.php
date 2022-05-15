<?php

use App\Http\Controllers\Api\BookableAvailabilityController;
use App\Models\Bookable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookableController;

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

// Route::get('bookables', function(Request $request){
//     return Bookable::all();
// });

// Route::get('bookables/{id}', function(Request $request, $id){
//     return Bookable::find($id);
// });

// Route::get('bookables', [BookableController::class, 'index']);
// Route::get('bookables/{id}', [BookableController::class, 'show']);
Route::apiResource('bookables', BookableController::class);
Route::get('bookables/{bookable}/availability', BookableAvailabilityController::class);