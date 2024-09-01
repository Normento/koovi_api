<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Response;


/**
     * Enregistrement.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
 */
class ContactController extends Controller
{
    public function store(StoreContactRequest $request)
    {

        $contact = Contact::create($request->validated());

        return response()->json([
            'message' => 'Le contact a été enregistré avec succès.',
            'data' => $contact
        ], Response::HTTP_CREATED);
    }
}
