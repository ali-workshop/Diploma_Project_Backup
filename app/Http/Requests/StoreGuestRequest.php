<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
<<<<<<< HEAD
        return false;
=======
        return true;
>>>>>>> repoB/main
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
<<<<<<< HEAD
            //
=======
            'name' => 'required|string|max:100',
            'birthDate' => 'required|date',
            'phone_number' => 'nullable|string|regex:/^[0-9]{10}$/',
            'identificationNumber' => 'required|string|max:50|unique:guests',
>>>>>>> repoB/main
        ];
    }
}
