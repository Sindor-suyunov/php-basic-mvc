<?php

use App\Controllers\HomeController;
use Core\Routing\Route;

Route::get('/new/{save}', HomeController::class, 'show');
Route::get('/main/new', HomeController::class, 'show');
Route::get('/', HomeController::class, 'index');


