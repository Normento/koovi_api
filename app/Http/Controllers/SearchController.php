<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Cours;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Rechercher document.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $keyword = $request->input('keyword');

        if ($type === 'publication') {
            $query = Publication::query();
        } elseif ($type === 'cours') {
            $query = Cours::query();
        } else {
            return response()->json(['error' => 'Invalid type'], 400);
        }

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        if ($keyword) {
            $query->where('slug', 'like', '%' . $keyword . '%');
        }

        $results = $query->get();

        $transformedResults = $results->map(function ($item) {
            // Pour les publications
            if ($item instanceof Publication) {
                $item->image =  asset('storage/' . $item->image);
                $item->file = asset('storage/' . $item->file);
            }
            // Pour les cours
            if ($item instanceof Cours) {
                $item->image =  asset('storage/' . $item->image);
                $item->file = asset('storage/' . $item->file);
            }
            return $item;
        });

        return response()->json($transformedResults);

    }
}
