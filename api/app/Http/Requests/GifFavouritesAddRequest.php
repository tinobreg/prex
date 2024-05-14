<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GifFavouritesAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'gif_id' => 'required|string|max:255',
            'alias' => 'required|string|max:255'
        ];
    }
}
