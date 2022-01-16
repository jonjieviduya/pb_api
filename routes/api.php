<?php

use App\Http\Controllers\PizzaController;

Route::get('pizzas', [PizzaController::class, 'index']);
Route::post('search', [PizzaController::class, 'search']);
Route::post('store', [PizzaController::class, 'store']);
