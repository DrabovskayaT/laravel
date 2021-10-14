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
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\ServiсeController;
use App\Models\Service;
use Illuminate\Foundation\Auth\EmailVerificationRequest;




Route::middleware([Cors::class])->group(function () {
  Route::post('/register', [RegisterController::class, 'register']);
  Route::post('/login', [LoginController::class, 'login'])->name('login');
  Route::get('/services', [ServiсeController::class, 'getList']);
  Route::get('/services/{slug}', [ServiсeController::class, 'getDetail']);

  // Route::get('/services/{slug}', function ($slug) {
  //   return Service::whereSlug($slug)->firstOrFail();
  // });

  Route::post('/services/add', [ServiсeController::class, 'add']);
  // Route::post('/services-add', [ServiсeController::class, 'add']);
  Route::middleware('auth:api')->group(
    function () {
      Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
      //   Route::get('/user', [UserController::class, 'user']);
    }

  );
});

Route::middleware('auth:api')->group( function () {
  Route::resource('products', 'API\ProductController');
});

Route::get('/email/verify', function () {
  return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();

  return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
  $request->user()->sendEmailVerificationNotification();

  return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Route::group(['namespace' => 'Api'], function () {
  //  Route::group(['namespace' => 'Api\Auth'], function () {
     //   Route::post('/register', 'RegisterController@register');
    //    Route::post('login', 'LoginController');
    //    Route::post('logout', 'LogoutController')->middleware('auth:api');
  //  });
// });