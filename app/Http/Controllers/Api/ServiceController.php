<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Serviсes\ServiсeService;
use App\Helpers\HelperJson;
use App\Http\Requests\Api\ServiceRequest;
use \Exception;

/**
 * Controller for reuest data servise
 */
class ServiceController extends Controller
{
    /**
     * Get all servises
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getList(Request $request)
    {
        try {
            $result = ServiсeService::getList();
            return HelperJson::sendAnswer($result, config('message.success'), 200);
        } catch (Exception $th) {
            return $th->getMessage();
        }
    }

    /**
     * Add servises
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(ServiceRequest $request)
    {
        try {
            $result = ServiсeService::add($request);
            return HelperJson::sendAnswer($result, config('message.success'), 200);
        } catch (Exception $th) {
            return $th->getMessage();
        }
    }

    /**
     * Get detail servises
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
        } catch (Exception $th) {
            return $th->getMessage();
        }
    }
}
