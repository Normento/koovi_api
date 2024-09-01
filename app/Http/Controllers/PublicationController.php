<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publications = Publication::all()->map(function ($publication) {
            $publication->image = asset('storage/' . $publication->image);

            if ($publication->file) {
                $publication->file = asset('storage/' . $publication->file);
            }

            return $publication;
        });

        return response()->json($publications);
    }
}
