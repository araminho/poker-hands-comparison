<?php

namespace App\Http\Controllers;

use App\Models\Hand;
// use Illuminate\Http\Request;

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
        $hand = new Hand('7D 2S 5D 3S AC');
        $hand->normalize();
        // echo "<pre>"; print_r($hand->getCards()); exit;
        return view('home');
    }
}
