<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        // Example of dynamic data
        $data = [
            'title' => 'Welcome to Shadesoftx',
            'description' => 'We create stunning websites tailored to your needs.',
        ];

        return view('home', $data);
    }

    public function about()
    {
        // Add data for the about page
        return view('about', ['title' => 'About Us']);
    }
}
