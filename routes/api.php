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
use App\Http\Controllers\Api\ServiceController;
use App\Models\Service;
use App\Http\Controllers\Api\VerificationApiController;




Route::middleware([Cors::class])->group(function () {

  Route::post('/register', [RegisterController::class, 'register'])->name('register');
  Route::post('/login', [LoginController::class, 'login'])->name('login');

  Route::middleware('auth:api')->group(

    function () {
      Route::get('/services', [ServiceController::class, 'getList'])->name('services');

      Route::post('/services-add', [ServiceController::class, 'add'])->name('services-add');

      Route::get('/services/{slug}', [ServiceController::class, 'getDetail'])->name('services-detail');

      Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    }

  );
  Route::get('/email/verify', function () {
    return view('auth.verify-email');
  })->middleware('auth')->name('verification.notice');


  Route::get('email/verify/{id}', [VerificationApiController::class, 'verify'])->name('verificationapi.verify');
Route::get('email/resend',  [VerificationApiController::class, 'resend'])->name('verificationapi.resend');



});
