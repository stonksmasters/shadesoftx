<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/residential', function () {
    return view('residential');
});

Route::get('/commercial', function () {
    return view('commercial');
});

Route::get('/commercial-glazing', function () {
    return view('commercial-glazing');
});

Route::get('/home-window-tint', function () {
    return view('home-window-tint');
});

Route::get('/reviews', function () {
    return view('reviews');
});

Route::get('/booking', function () {
    return view('booking');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/navbar', function () {
    return view('navbar');
});

Route::get('/footer', function () {
    return view('footer');
});

Route::get('/hero', function () {
    return view('hero');
});

// Additional routes for future pages
Route::get('/about', function () {
    return view('about');
});

Route::get('/gallery', function () {
    return view('gallery');
});

Route::get('/pella', function () {
    return view('pella');
});

// POST route for booking form submission
Route::post('/appointments', [FormController::class, 'store'])->name('appointments.store');

// POST route for contact form submission
Route::post('/contact', [FormController::class, 'contact'])->name('contact.submit');
