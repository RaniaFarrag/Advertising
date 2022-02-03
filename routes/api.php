<?php

use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Http\Request;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix'=>'v1'], function (){
    Route::post('/login', [AuthController::class, 'login']);

    Route::group(['middleware'=>'jwt.verify'], function (){
        Route::group(['middleware'=>'isAdmin'], function (){
            // Manage Tag (view, create, edit, delete)
            Route::apiResource('tags', TagController::class);

            // Manage Categories (view, create, edit, delete)
            Route::apiResource('categories', CategoryController::class);

            // View All Ads
            Route::get('ads', [AdController::class, 'index']);

            // Creat Ad
            Route::post('store/ads', [AdController::class, 'store']);

        });

        // Show Advertiser's Ads
        Route::get('show/advertiser/ads', [AdController::class, 'showAdvertiserAds']);

        // Filter Ads By Category or Tag
        Route::post('filter/ads', [AdController::class, 'filterAds']);

    });


});
