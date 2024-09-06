<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::
                     paginate(10);

        $blogs->getCollection()->transform(function ($blog) {
            if ($blog->image) {
                $filePath = storage_path('app/public/' . $blog->image);
                if (file_exists($filePath)) {
                    $blog->image_url = asset('storage/' . $blog->image);
                } else {
                    $blog->image_url = null;
                }
            } else {
                $blog->image_url = null;
            }
            return $blog;
        });

        return response()->json($blogs);
    }


    public function show(string $slug){
        if ($slug == null) {
            return response()->json(['message' => 'Blog not found'], 404);
        }
        $data = Blog::where('slug',$slug)->get();

        $data->transform(function ($blog) {
            if ($blog->image) {
                $filePath = storage_path('app/public/' . $blog->image);
                if (file_exists($filePath)) {
                    $blog->image_url = asset('storage/' . $blog->image);
                } else {
                    $blog->image_url = null;
                }
            } else {
                $blog->image_url = null;
            }
            return $blog;
        });
        return response()->json($data);
    }
}


