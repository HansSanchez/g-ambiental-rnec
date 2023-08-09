<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TreePlantationStoreRequest extends FormRequest
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
            'number_of_trees_planted' => 'required',
            'date' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'observations' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'number_of_trees_planted.required' => 'El número de árboles que fueron plantados es requerido',
            'date.required' => 'La fecha de plantación es requerida',
            'address.required' => 'La dirección en donde fue la plantación es requerida',
            'lat.required' => 'La coordenada de latitud es requerida',
            'lng.required' => 'La coordenada de longitud es requerida',
            'observations.required' => 'Las observaciones (especies plantadas) son requeridas',
        ];
    }
}
