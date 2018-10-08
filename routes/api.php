<?php

use Illuminate\Http\Request;

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
//
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/v1/auth/login', 'Api\\AuthApi@testlogin');
Route::namespace('Api')->group(function ($app) {
    include( dirname(dirname(__FILE__)). '/lib/app/Http/routes.php');
});

//Route::post('/api/login', 'Api\\AuthApi@login');
