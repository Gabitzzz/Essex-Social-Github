<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImage extends FormRequest
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
            'avatar' => 'image|mimes:jpeg,jpg,png,gif,svg|max:16384',
            'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:16384',
            'partyImg' => 'image|mimes:jpeg,jpg,png,gif,svg|max:16384',
            'eventImg' => 'image|mimes:jpeg,jpg,png,gif,svg|max:16384',
            'degreePicture' => 'image|mimes:jpeg,jpg,png,gif,svg|max:16384',
        ];
    }
}
