<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'code' => 'string|max:100',
            'price' => 'decimal:0,2|between:0,999999.99',
            'floorNumber' => 'numeric|integer|max:15',
            'description' => 'string|max:800',
            'img' => 'image',
            'status' => 'string|in:available,booked',
        ];
    }
}
