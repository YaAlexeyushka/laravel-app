<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;

Route::apiResource('posts', PostController::class);
Route::post('posts/{id}/restore', [PostController::class, 'restore']);
Route::delete('posts/{id}/force', [PostController::class, 'forceDelete']);

Route::apiResource('categories', CategoryController::class);

Route::apiResource('comments', CommentController::class);
Route::post('comments/{id}/restore', [CommentController::class, 'restore']);
Route::delete('comments/{id}/force', [CommentController::class, 'forceDelete']);

Route::apiResource('tags', TagController::class);
