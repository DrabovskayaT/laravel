<?php

namespace App\Helpers;

use App\Services\Formatters\Page\NotFoundFormatter;
use App\Models\User;

use App;

/**
 * Вспомогательный класс для обработки формата ответов на запросы
 *
 * Class HelperJson
 * @package App\Helpers
 */
class HelperJson
{
    /**
     * Метод преобразует данные в json формат
     *
     * @param $data
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public static function sendJson($data)
    {
        if (is_array($data) || $data instanceof \Illuminate\Support\Collection || $data instanceof \stdClass) {
            return response()->json($data);
        }

        return false;
    }

    /**
     * Метод преобразует данные в json формат
     *
     * @param $data
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public static function sendAnswer($data = null, $message = null, $code = 400)
    {
        if (is_array($data) || $data instanceof \Illuminate\Support\Collection || $data instanceof \Illuminate\Database\Eloquent\Model) {
            return response()->json($message, $code);
        }

        return config('message.error');
    }

    

    /**
     * Метод принимает текст сообщения, массив данных для вывода
     * и возвращает статус запроса, текст сообщения и данные
     *
     * @param string|null $message
     * @param array $attributes
     * @return \Illuminate\Http\JsonResponse
     */
    public static function sendSuccess(string $message = null, array $attributes = [])
    {
        $result = [
            "status" => true,
            "message" => $message ?: 'Запрос успешно выполнен',
        ];

        if (!empty($attributes) && is_array($attributes)) {
            $result = array_merge($result, $attributes);
        }

        return response()->json($result, 200);
    }
}
