<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'personal_id' => 'required',
            'first_name' => 'required',
            'first_last_name' => 'required',
            'delegation' => 'required',
            'position' => 'required',
            'phone_number' => 'required',
            'active' => 'required',
            'email' => 'required|email|unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            'personal_id.required' => 'La cédula del/la colaborador/a es requerido/a',
            'first_name.required' => 'El nombre del/la colaborador/a es requerido/a',
            'first_last_name.required' => 'El nombre del/la colaborador/a es requerido/a',
            'delegation.required' => 'La delegación en donde se va a desempeñar es requerida',
            'position.required' => 'El cargo que va a desempeñar es requerido',
            'phone_number.required' => 'El número de celular es requerido',
            'active.required' => 'El estado es requerido',
            'email.required' => 'El correo electrónico ahora es requerido',
            'email.email' => 'El correo electrónico que estás ingresando no tiene un formato adecuado',
            'email.unique' => 'El correo electrónico que estás ingresando ya está en uso por otro usuario',
        ];
    }
}
