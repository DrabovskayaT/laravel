<?php

namespace App\Servises;

use App\Models\User;
use App\Http\Requests\Api\Auth\RegisterFormRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Auth\LoginFormRequest;

/**
 * Сервис для обработки логики аутентификации
 *
 * Class AuthService
 * @package App\Services
 */
class AuthService
{

    /**
     * Undocumented function
     *
     * @param RegisterFormRequest $data
     * @return void
     */
    public static function register(RegisterFormRequest $data)
    {
        $user =  User::create(array_merge(
            $data->only('name', 'email'),
            ['password' => bcrypt($data->password)],
        ));

        return $user;
    }


    /**
     * Undocumented function
     *
     * @param Request $data
     * @return void
     */
    public static function login(LoginFormRequest $data)
    {
        $credentials = $data->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return abort(401);
        }

        $token = Auth::user()->createToken(config('app.name'));
        $token->token->expires_at = Carbon::now()->addDay();

        $token->token->save();

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString()
        ], 200);
    }
}
