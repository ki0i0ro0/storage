<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storingRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
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