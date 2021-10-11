<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\HelperJson;
use App\Http\Controllers\Controller;
use App\Servises\AuthService;
use App\Http\Requests\Api\Auth\RegisterFormRequest;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterFormRequest $request)
    {
        try {
            $result =   AuthService::register($request);
           // $message = 'You were successfully registered. Use your email and password to sign in.';
            return HelperJson::sendAnswer($result, config('message.success'), 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error'
            ], 400);
        }
    }
}
