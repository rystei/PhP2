<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;


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
Route::post('postagem', [PostController::class, 'store']);
Route::get('postagem', [PostController::class, 'index']);
Route::delete('postagem/deletar/{id}', [PostController::class, 'destroy']);
Route::put('postagem/{id}', [PostController::class, 'edit']);
Route::get('postagem/{id}', [PostController::class, 'show']);

Route::post('comentario/{id}', [CommentController::class, 'store']);
Route::get('comentario', [CommentController::class, 'index']);
Route::delete('comentario/deletar/{id}', [CommentController::class, 'destroy']);
Route::put('comentario/{id}', [CommentController::class, 'edit']);
Route::get('comentario/{id}', [CommentController::class, 'show']);
