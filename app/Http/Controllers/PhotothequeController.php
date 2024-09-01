<?php

namespace App\Http\Controllers;

use App\Models\Phototheque;
use Illuminate\Http\Request;

class PhotothequeController extends Controller
{
    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phototheques = Phototheque::all()->map(function ($phototheque) {
            $phototheque->image = asset('storage/' . $phototheque->image);
            return $phototheque;
        });

        return response()->json($phototheques);
    }
}
