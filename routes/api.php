<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PhotothequeController;
use App\Http\Controllers\PublicationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('abouts', [AboutController::class, 'index']);

Route::get('blogs', [BlogController::class, 'index']);

Route::get('blogs/{slug}', [BlogController::class, 'show']);

Route::post('contacts', [ContactController::class, 'store']);

Route::get('cours', [CoursController::class, 'index']);

Route::get('cours/{slug}', [CoursController::class, 'show']);


Route::post('newsletter', [NewsletterController::class, 'store']);

Route::get('phototheque', [PhotothequeController::class, 'index']);

Route::get('publications', [PublicationController::class, 'index']);

Route::get('publications/{slug}', [PublicationController::class, 'show']);


Route::get('homes', [HomeController::class, 'index']);

Route::get('search', [SearchController::class, 'index']);

Route::get('archives', [ArchiveController::class, 'index']);








