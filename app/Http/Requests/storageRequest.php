<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
    *public function authorize()
    *{
    *    return false;
    *}
     */

    /**
     * Get the validation rules that apply to the request.
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
