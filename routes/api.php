<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get all posts
Route::get("/posts",[PostController::class, 'index']);

// Create post
Route::post("/posts",[PostController::class , 'store']);

// update post 
Route::put('/posts/{id}',[PostController::class,"update"]);

//delete route

Route::delete("/posts/{id}",[PostController::class,"destroy"]);