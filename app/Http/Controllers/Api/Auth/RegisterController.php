<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\HelperJson;
use App\Http\Controllers\Controller;
use App\Serviсes\AuthService;
use App\Http\Requests\Api\Auth\RegisterFormRequest;

/**
 * Registration user class
 */
class RegisterController extends Controller
{
    /**
     * @OA\Post(
     *     path="/register",
     *     summary="Регистрация пользователя",
     *     tags={"auth"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     format="email"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                      type="string",
     *                       writeOnly="true"
     *                 ),
     *                
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             oneOf={
     *                 @OA\Schema(ref="#/components/schemas/Result"),
     *                 @OA\Schema(type="boolean")
     *             },
     *             @OA\Examples(example="result", value={"success": true}, summary="An result object."),
     *             @OA\Examples(example="bool", value=false, summary="A boolean value."),
     *         )
     *     )
     * )
     */

    /**
     * @OA\Schema(
     *  schema="Result",
     *  title="Sample schema for using references",
     * 	@OA\Property(
     * 		property="status",
     * 		type="string"
     * 	),
     * 	@OA\Property(
     * 		property="error",
     * 		type="string"
     * 	)
     * )
     */
    public function register(RegisterFormRequest $request)
    {
        try {
            $result =   AuthService::register($request);
            return HelperJson::sendAnswer($result, config('message.success'), 200);
        } catch (\Throwable $th) {
            return HelperJson::sendAnswer(config('message.error'), 400);
        }
    }
}
