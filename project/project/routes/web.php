<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\SessionController;
use Illuminate\Support\Facades\Gate;


Route::middleware('auth')->group(function () {

    //index
    Route::get('/ideas', [IdeaController::class, 'index'])->middleware('auth');

    //create
    Route::get('/ideas/create', [IdeaController::class, 'create']);

    //show
    Route::get('/ideas/{idea}', [IdeaController::class, 'show']);

    //edit
    Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit']);

    //update
    Route::patch('/ideas/{idea}', [IdeaController::class, 'update']);

    //store
    Route::post('/ideas', [IdeaController::class, 'store']);

    //destroy
    Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy']);



    Route::delete('/logout', [SessionController::class, 'destroy']);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterUserController::class, 'create']);
    Route::post('/register', [RegisterUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});


// Route::get('/admin', function () {
//     return 'private admin page';
// })->can('view-admin');

// Route::get('/delete-ideas', function () {

//     Idea::truncate();

//     return redirect('/ideas');
// });
// Route::get('/about', function () {
//     return view('about');
// });

// Route::get('/contact', function () {
//     return view('contact');
// });

// Route::view('/', 'welcome', [
//     'greeting' => 'Hello',
//     'person' => request('person', 'Guest'),
// ]);

// Route::view('/', 'welcome', [
//     'Tasks' => ['Task 1', 'Task 2', 'Task 3']
// ]);

// Route::view('/about', 'about');
// Route::view('/contact', 'contact');
