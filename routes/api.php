<?php

use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;
use App\Models\User;
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


Route::group(['prefix'=>'v1'], function (){

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::group(['middleware'=>'jwt.verify'], function (){
        // This Routes Need that user is Admin
        Route::group(['middleware'=>'isAdmin'], function (){
            // Manage Tag (view, create, edit, delete)
            Route::apiResource('tags', TagController::class);

            // Manage Categories (view, create, edit, delete)
            Route::apiResource('categories', CategoryController::class);

            // Creat Ad
            Route::post('store/ads', [AdController::class, 'store']);

            // Show Advertiser's Ads
            Route::get('show/advertiser/ads', [AdController::class, 'showAdvertiserAds']);
        });

        // View All Ads
        Route::get('ads', [AdController::class, 'index']);

        // Show MY Ads
        Route::get('show/my/ads', [AdController::class, 'showMyAds']);

        // Filter Ads By Category or Tag
        Route::post('filter/ads', [AdController::class, 'filterAds']);

    });

});
