<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::whereNull('deleted_at')->get();

        $abouts = $abouts->map(function ($about) {
            if ($about->image) {
                $about->image_url = asset('storage/' . $about->image);
            } else {
                $about->image_url = null;
            }
            return $about;
        });

        return response()->json($abouts);
    }
}
