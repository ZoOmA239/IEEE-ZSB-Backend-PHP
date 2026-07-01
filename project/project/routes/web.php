<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController;

//index
Route::get('/ideas', [IdeaController::class, 'index']);

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
