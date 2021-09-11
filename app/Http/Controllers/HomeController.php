<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the dashboard of the application
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        return view('dashboard', ['title' => 'Dashboard 1']);
    }
}