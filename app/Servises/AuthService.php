<?php

namespace App\Servises;

use App\Models\User;
use App\Servises\AbstractHelperServises;
use App\Http\Requests\Api\Auth\RegisterFormRequest;


/**
 * Сервис для обработки логики аутентификации
 *
 * Class AuthService
 * @package App\Services
 */
class AuthService
{
    /**
     * Метод принимает массив данных для регистрации.
     * При успешной авторизации возвращает объект пользователя, содержащий токен доступа к личным данным.
     *
     * @param array $data
     * @return array|bool
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
     * Метод генерирует массив данных для регистрации из запроса
     *
     * @param RegisterRequest $request
     * @return array
     */
    public static function formatDataRegister(RegisterRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        return $data;
    }
}
