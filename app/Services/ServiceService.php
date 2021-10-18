<?php

namespace App\Serviсes;

use Illuminate\Support\Facades\Redis;
use App\Models\Service;
use Illuminate\Support\Str;

/**
 * Сервис для обработки логики Eloquent Service
 *
 * Class AuthService
 * @package App\Services
 */
class ServiсeService
{
    /**
     * Метод для получения разводящей страницы сервисов
     *
     * @param Type|null $var
     * @return void
     */
    public static function getList()
    {

        foreach (Service::lazy() as $servise) {
            dd($servise);
        }
    }

    /**
     * Метод для добавления нового сервиса
     *
     * @param Request $data
     * @return void
     */
    public static function add($data)
    {
        $servise = $data->only('title', 'desc', 'price', 'art');
        $servise['slug'] = Str::slug($servise['title'], '-');
        return  Service::create($servise);
    }

    /**
     * Метод получения детальной страницы сервиса
     *
     * @param String|null $slug
     * @return void
     */
    public static function getDetail(String $slug = null)
    {
     //   $service = new ServiсeService(); // ооочень не хотела делать self но хз как тут лучше
        $id = self::getForSlug($slug);
        $cachedBlog = Redis::get('services_' . $id);

        if (isset($cachedBlog)) {
            $blog = json_decode($cachedBlog, FALSE);

            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from redis',
                'data' => $blog,
            ]);
        } else {
            $blog = Service::find($id);
            $blog->toJson();
            Redis::set('services_' . $id, $blog);

            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from database',
                'data' => $blog,
            ]);
        }
    }

    /**
     * Метод получения id по слагу сервиса
     *
     * @param String $slug
     * @return void
     */
    public static function getForSlug(String $slug)
    {
        try {
            return Service::whereSlug($slug)->value('id');
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
