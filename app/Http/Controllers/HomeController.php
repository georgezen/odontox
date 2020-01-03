<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function checar()
    {
        Flash::success('Bienvenido al sistema, por favor ponga su huella en el detector');
        return view('checar');
    }
}
