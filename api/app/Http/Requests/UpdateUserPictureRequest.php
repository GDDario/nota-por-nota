<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPictureRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'original_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
