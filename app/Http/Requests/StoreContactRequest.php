<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'objet'      => 'required|string|max:255',
            'messages'   => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Le prénom est obligatoire.',
            'first_name.string'   => 'Le prénom doit être une chaîne de caractères.',
            'first_name.max'      => 'Le prénom ne peut pas dépasser 255 caractères.',
            'last_name.required'  => 'Le nom de famille est obligatoire.',
            'last_name.string'    => 'Le nom de famille doit être une chaîne de caractères.',
            'last_name.max'       => 'Le nom de famille ne peut pas dépasser 255 caractères.',
            'email.required'      => 'L\'adresse e-mail est obligatoire.',
            'email.email'         => 'L\'adresse e-mail n\'est pas valide.',
            'email.max'           => 'L\'adresse e-mail ne peut pas dépasser 255 caractères.',
            'objet.required'      => 'L\'objet est obligatoire.',
            'objet.string'        => 'L\'objet doit être une chaîne de caractères.',
            'objet.max'           => 'L\'objet ne peut pas dépasser 255 caractères.',
            'messages.required'   => 'Le message est obligatoire.',
            'messages.string'     => 'Le message doit être une chaîne de caractères.',
        ];
    }
}
