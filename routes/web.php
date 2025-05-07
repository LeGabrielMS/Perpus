<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum', 'verified', 'admin'])->group(function () {
    route::get('/home', [AdminController::class, 'index']);
    route::get('/categories_page', [AdminController::class, 'categories_page']);

    route::post('/add_category', [AdminController::class, 'add_category']);
    route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);
    route::get('/edit_category/{id}', [AdminController::class, 'edit_category']);
    route::post('/update_category/{id}', [AdminController::class, 'update_category']);

    route::get('/add_book', [AdminController::class, 'add_book']);
    route::post('/store_book', [AdminController::class, 'store_book']);
    route::get('/view_book', [AdminController::class, 'view_book']);
    route::get('/delete_book/{id}', [AdminController::class, 'delete_book']);
    route::get('/edit_book/{id}', [AdminController::class, 'edit_book']);
    route::post('/update_book/{id}', [AdminController::class, 'update_book']);

    route::get('/borrow_request', [AdminController::class, 'borrow_request']);
    Route::get('/borrow_status/{id}/{status?}', [AdminController::class, 'borrow_status'])->name('borrow_status');
});


route::get('book_details/{id}', [HomeController::class, 'book_details']);
route::get('/borrow_books/{id}', [HomeController::class, 'borrow_books']);

Route::get('/borrow_history', [HomeController::class, 'borrow_history']);
Route::post('/cancel_borrow/{id}', [HomeController::class, 'cancel_borrow'])->name('cancel_borrow');

route::get('explore', [HomeController::class, 'explore']);
