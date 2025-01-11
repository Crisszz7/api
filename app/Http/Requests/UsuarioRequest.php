<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'nombre' => 'required|max:255|min:3',
            'apellido' => 'required|max:255|min:3',
            'identificacion' => 'required|numeric',
            'celular' => 'nullable',
            'ficha_id' => 'nullable', 
            'rol_id' => 'required',
        ];
    }
}
