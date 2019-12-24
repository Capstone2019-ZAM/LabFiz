<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if ( !Gate::allows('isUser')){
            abort(503,"Sorry, You do not have access to this page");
        }

        return view('home');
    }
}
