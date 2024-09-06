<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Cours;
use App\Models\Phototheque;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    /**
     * Archive
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->input('type');

        if ($type === 'document') {
            $publications = Publication::where('archive', 1)->get();
            $cours = Cours::where('archive', 1)->get();

            // Transformer les résultats
            $publications = $publications->map(function ($item) {
                if ( $item->image || $item->file) {
                    $item->image = asset('storage/' . $item->image);
                    $item->file = asset('storage/' . $item->file);
                }else{
                    $item->image = null;
                    $item->file = null;
                }
                return $item;
            });

            $cours = $cours->map(function ($item) {
                if ( $item->image || $item->file) {
                    $item->image = asset('storage/' . $item->image);
                    $item->file = asset('storage/' . $item->file);
                }else{
                    $item->image = null;
                    $item->file = null;
                }
                return $item;
            });

            return response()->json([
                'publications' => $publications,
                'cours' => $cours
            ]);

        } elseif ($type === 'photo') {
            $phototheque = Phototheque::where('archive', 1)->get();

            $phototheque = $phototheque->map(function ($item) {
                $item->image = asset('storage/' . $item->image);
                return $item;
            });

            return response()->json($phototheque);
        }
        else{
            return response()->json(['error' => 'Invalid type'], 400);
        }
    }
}
