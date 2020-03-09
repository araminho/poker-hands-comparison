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
        $hand1 = new Hand('TS JS KS QS AS');
        $hand2 = new Hand('3H 4H 4S 4C 5D');
        $hand1->normalize();
        $hand2->normalize();
        echo Hand::compareHands($hand1, $hand2);
        // exit;
        // echo "<pre>"; print_r($hand->getCards()); exit;
        return view('home');
    }
}
