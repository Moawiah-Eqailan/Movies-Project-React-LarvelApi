<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ContactController;
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


// Movie API Routes
Route::get('/movies', [MovieController::class, 'index']);// List all movies
Route::get('/movie/{id}', [MovieController::class, 'detail']);// Get movie details by ID
Route::get('/favorites', [MovieController::class, 'favoriteList'])// Get favorites for user
    ->middleware('auth:sanctum');
Route::get('/movies/search/{search}', [MovieController::class, 'search']);      // Search for movies
Route::get('/genres',[GenreController::class, 'index']); // get the genres list
Route::get('/genres/{id}' ,[GenreController::class, 'getMoviesBasedGenre']);// get movies based genre

Route::controller(RegisterController::class)->group(function(){
Route::post('register', 'register');
Route::post('login', 'login');
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', action: [ProfileController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/has-fav/{movieID}', [RegisterController::class, 'hasFavorited']);
    Route::post('/add-comments/{movieId}', [CommentController::class, 'store']);
    Route::get('/comments/{movieId}', [CommentController::class, 'index']);
    Route::post('/add-favorite/{id}', [FavoriteController::class, 'add']);// add a new favorite
Route::post('/remove-favorite/{id}', [FavoriteController::class, 'remove']);// remove a favorite
});

Route::get('/movies/{movieId}/comments', [CommentController::class, 'index']);

Route::post('/contacts', [ContactController::class, 'store']);
