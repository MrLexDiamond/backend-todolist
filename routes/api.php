<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodolistController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('todolist', [TodolistController::class, 'index']); 
Route::post('todolist', [TodolistController::class, 'store']);
Route::get('todolist/{id}', [TodolistController::class, 'show']);
Route::get('todolist/{id}/edit', [TodolistController::class, 'edit']);
Route::put('todolist/{id}/edit', [TodolistController::class, 'update']);
Route::delete('todolist/{id}/delete', [TodolistController::class, 'destroy']);