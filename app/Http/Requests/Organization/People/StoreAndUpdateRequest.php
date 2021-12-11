<?php

namespace App\Http\Requests\Organization\People;

use Illuminate\Foundation\Http\FormRequest;

class StoreAndUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required|max:20',
            'email' => 'required|email',
            'avatar' => 'nullable|max:2048|mimes:png,jpg,jpeg'
        ];
    }
}
