<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cours = Cours::whereNull('deleted_at')
                ->where('archive',0)
                ->get();

        $cours->transform(function ($cour) {
            if ($cour->image) {
                $cour->image = asset('storage/' . $cour->image);
            }

            if ($cour->file) {
                $cour->file = asset('storage/' . $cour->file);
            }
            return $cour;
        });

        return response()->json($cours);
    }

    public function show(string $slug){
        if ($slug == null) {
            return response()->json(['message' => 'Cours not found'], 404);
        }
        $data = Cours::where('slug',$slug)->get();

        $data->transform(function ($cour) {
            if ($cour->image) {
                $cour->image = asset('storage/' . $cour->image);
            }

            if ($cour->file) {
                $cour->file = asset('storage/' . $cour->file);
            }
            return $cour;
        });
        return response()->json($data);
    }
}
