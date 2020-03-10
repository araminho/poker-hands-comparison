<?php

namespace App\Http\Controllers;

use App\Models\Hand;
use Illuminate\Http\Request;

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
        return view('home');
    }


    public function compare(Request $request)
    {
        $hand1 = new Hand($request->input('hand1'));
        $hand2 = new Hand($request->input('hand2'));
        return Hand::compareHands($hand1, $hand2);
    }
}
