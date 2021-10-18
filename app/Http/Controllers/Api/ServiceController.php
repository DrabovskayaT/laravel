<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Serviсes\ServiсeService;
use App\Helpers\HelperJson;
use App\Http\Requests\Api\ServiceRequest;

/**
 * Undocumented class
 */
class ServiceController extends Controller
{
    /**
     * Метод получает список всех сервисов
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getList(Request $request)
    {
        try {
            $result = ServiсeService::getList();
            return HelperJson::sendAnswer($result, config('message.success'), 200);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Метод добавляет услугу
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(ServiceRequest $request)
    {
        try {
            $result = ServiсeService::add($request);
            return HelperJson::sendAnswer($result, config('message.success'), 200);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Метод получает детальную карточку услуги
     *
     * @param Type|null $var
     * @return void
     */
    public function getDetail(Request $request)
    {
        try {
            if (!empty($request->slug)) {
                $result = ServiсeService::getDetail($request->slug);
                return HelperJson::sendAnswer($result, config('message.success'), 200);
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
