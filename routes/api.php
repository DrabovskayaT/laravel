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

  Route::post('/register', [RegisterController::class, 'register'])->name('register');
  Route::post('/login', [LoginController::class, 'login'])->name('login');

  Route::middleware('auth:api')->group(

    function () {
      Route::get('/services', [ServiсeController::class, 'getList'])->name('services');

      Route::post('/services-add', [ServiсeController::class, 'add'])->name('services-add');

      Route::get('/services/{slug}', [ServiсeController::class, 'getDetail'])->name('services-detail');

      Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    }

  );
  Route::get('/email/verify', function () {
    return view('auth.verify-email');
  })->middleware('auth')->name('verification.notice');
});
