<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterUserController;

Route::get('/', fn() => view('welcome'));

Route::get('/register', [RegisterUserController::class, 'create']);
