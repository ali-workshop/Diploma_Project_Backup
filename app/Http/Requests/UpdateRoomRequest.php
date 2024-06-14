<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoomRequest extends FormRequest
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
            'code' =>['nullable' ,'string','max:100',Rule::unique('rooms')->ignore($this->room)],
            'floorNumber' => 'nullable|numeric|integer|max:15',
            'description' => 'nullable|string|max:800',
            'images' => 'nullable|image',
            'images.*' => 'nullable|image|max:2048',
            'new_images.*' => 'nullable|image|max:2048',
            'status' => 'nullable|string|in:available,unavailable',
        ];
    }
}
