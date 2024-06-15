<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
            // ^[1-9]{1,2}: The room code starts with 1 or 2 digits representing the room number.
            // [A-Z]?: An optional single uppercase letter, which might be used to designate a specific wing or section (e.g., A, B).
            // [0-15]{1}$: Ends with 1 digits representing  the floor number.
            'code' => 'required|string|regex:/^[1-9]{1,2}[A-Z]?[0-15]{1}$/|max:100',
            'floorNumber' => 'required|numeric|integer|max:15',
            'description' => 'required|string|max:800',
            'images' => 'required', // fot the field
            'images.*' => 'image|max:2048', // for the files themselves
            'status' => 'required|string|in:available,booked',
        ];
    }
}

