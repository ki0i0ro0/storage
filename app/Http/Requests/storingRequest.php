<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storingRequest extends FormRequest
{

    /**
     * 仮入庫じの入力チェック
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'product_no' => 'required|integer',
            'cnt' => 'required|integer',
            'cost' => 'required|integer',
        ];
    }
}
