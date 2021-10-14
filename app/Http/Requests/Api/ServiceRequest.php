<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:services|max:255',
            'desc' => 'max:255',
            'price' => 'required|max:255',
            'art' => 'required|unique:services|max:255',
        ];
    }
}
