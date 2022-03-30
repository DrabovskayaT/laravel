<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Serviсes\AuthService;
use App\Http\Requests\Api\Auth\LoginFormRequest;
use \Exception;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\LoginFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginFormRequest $request)
    {
        try {
            $result = AuthService::login($request);
            return $result;
        } catch (Exception $th) {
            return $th;
        }
    }
}
