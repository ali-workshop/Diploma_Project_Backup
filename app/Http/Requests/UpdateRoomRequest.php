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
            'code' =>['string','max:100',Rule::unique('rooms')->ignore($this->room)],
            'floorNumber' => 'numeric|integer|max:15',
            'description' => 'string|max:800',
            'img' => 'image',
            'status' => 'string|in:available,booked',
        ];
    }
}
