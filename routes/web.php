<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

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

// Residential Service Detail Pages
Route::get('/safety-film', function () {
    return view('safety-film');
});

Route::get('/smart-tint', function () {
    return view('smart-tint');
});

Route::get('/shades', function () {
    return view('shades');
});

Route::get('/shutters', function () {
    return view('shutters');
});

Route::get('/blinds', function () {
    return view('blinds');
});

Route::get('/storm-shutters', function () {
    return view('storm-shutters');
});

Route::get('/shade-structures', function () {
    return view('shade-structures');
});

Route::get('/awnings', function () {
    return view('awnings');
});

Route::get('/screens', function () {
    return view('screens');
});

Route::get('/pella-windows', function () {
    return view('pella-windows');
});

Route::get('/pella-doors', function () {
    return view('pella-doors');
});

Route::get('/frameless-showers', function () {
    return view('frameless-showers');
});

Route::get('/window-cleaning', function () {
    return view('window-cleaning');
});

// Commercial Service Detail Pages
Route::get('/commercial-sun-control', function () {
    return view('commercial-sun-control');
});

Route::get('/commercial-security-film', function () {
    return view('commercial-security-film');
});

Route::get('/commercial-smart-tint', function () {
    return view('commercial-smart-tint');
});

Route::get('/commercial-awnings', function () {
    return view('commercial-awnings');
});

Route::get('/commercial-screens', function () {
    return view('commercial-screens');
});

Route::get('/commercial-roller-shades', function () {
    return view('commercial-roller-shades');
});

// POST route for booking form submission
Route::post('/appointments', [FormController::class, 'store'])->name('appointments.store');

// POST route for contact form submission
Route::post('/contact', [FormController::class, 'contact'])->name('contact.submit');
