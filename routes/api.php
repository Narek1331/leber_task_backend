<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\FileController;



Route::group([
    'prefix' => 'pokemon'
], function ($router) {
    Route::get('/', [PokemonController::class, 'index']);
    Route::get('/{id}', [PokemonController::class, 'show'])->where('id', '[0-9]+');;
    Route::post('/', [PokemonController::class, 'store']);
    // Route::put('/{id}', [PokemonController::class, 'update'])->where('id', '[0-9]+');;
    Route::post('/{id}', [PokemonController::class, 'update'])->where('id', '[0-9]+');;
    Route::delete('/{id}', [PokemonController::class, 'destroy'])->where('id', '[0-9]+');;
    // Route::get('/{id}/image', [PokemonController::class, 'getImage'])->where('id', '[0-9]+');;    
});

Route::group([
    'prefix' => 'image'
], function ($router) {
    Route::get('/', [FileController::class, 'index']);    
});