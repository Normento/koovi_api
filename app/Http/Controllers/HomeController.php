<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homes = Home::all()->map(function ($home) {
            $home->image = asset('storage/' . $home->image);

            return $home;
        });

        return response()->json($homes);
    }
}
