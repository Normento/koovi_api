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
        $phototheques = Phototheque::where('archive',0)
        ->paginate(10);

        $phototheques->getCollection()->transform(function ($phototeque) {
            if ($phototeque->image) {
                $phototeque->image = asset('storage/' . $phototeque->image);
            }

            if ($phototeque->file) {
                $phototeque->file = asset('storage/' . $phototeque->file);
            }
            return $phototeque;
        });

        return response()->json($phototheques);
    }
}
