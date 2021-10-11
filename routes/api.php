<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Cors;

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

use App\Http\Controllers\Api\Auth\RegisterController;


Route::middleware([Cors::class])->group(function () {
    Route::post('/register', [RegisterController::class, 'register']);
});




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['namespace' => 'Api'], function () {
  //  Route::group(['namespace' => 'Api\Auth'], function () {
     //   Route::post('/register', 'RegisterController@register');
    //    Route::post('login', 'LoginController');
    //    Route::post('logout', 'LogoutController')->middleware('auth:api');
  //  });
// });