<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomecareController;

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

Route::post('login', [HomecareController::class, 'login'])->name('homecare.login');

Route::middleware('auth:api')->group(function(){
    Route::get('categories',[HomecareController::class,'getCategories'])->name('homecare.categories');
    Route::get('{category}/brands',[HomecareController::class,'getBrands'])->name('homecare.brands');
    Route::get('{brand}/variants',[HomecareController::class,'getVariants'])->name('homecare.variants');
});
