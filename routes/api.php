<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Atau jika tidak menggunakan Sanctum, bisa kosongkan saja:
Route::get('/', function () {
    return response()->json(['message' => 'API is working']);
});