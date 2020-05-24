<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storageRequest extends FormRequest
{
    /**
     * 出庫時の入力チェック
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cnt' => 'required|integer',
            'selling' => 'required|integer',
        ];
    }
}