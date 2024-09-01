<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsletterRequest;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Enregistrement.
     *
     * @param  \App\Http\Requests\StoreNewsletterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsletterRequest $request)
    {
        $newsletter = Newsletter::create([
            'email' => $request->input('email'),
        ]);

        return response()->json([
            'message' => 'Inscription à la newsletter réussie.',
            'data' => $newsletter,
        ], 201);
    }
}
