<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTorreRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:255'],
            'latitud' => ['required', 'string', 'max:255'],
            'longitud' => ['required', 'string', 'max:255'],
            'comentarios' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'integer'],
        ];

    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'latitud.required' => 'La latitud es requerida',
            'longitud.required' => 'La longitud es requerida',
            'comentarios.required' => 'Los comentarios son requeridos',
            'estado.required' => 'El estado es requerido',
        ];
    }
}
