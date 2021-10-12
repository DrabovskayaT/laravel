<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Servises\AuthService;
use App\Http\Requests\Api\Auth\LoginFormRequest;
use App\Helpers\HelperJson;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginFormRequest $request)
    {
        try{
            $result = AuthService::login($request);
            return HelperJson::sendAnswer($result, config('message.success'), 200);
        }catch (\Throwable $th) {
            return $th;
        }
    }
}
