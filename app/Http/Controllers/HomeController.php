<?php

namespace App\Http\Controllers;

use App\Models\Deal;
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

    public function upload(Request $request)
    {
        $file = request()->file('file');
        $handle = fopen($file->getRealPath(), "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);
                if (strlen($line) == 29) {      // 10 cards, each 2 symbols + 9 spaces
                    $player1 = substr($line, 0, 14);
                    $player2 = substr($line, 15, 14);

                    $hand1 = new Hand($player1);
                    $hand2 = new Hand($player2);

                    $winner = Hand::compareHands($hand1, $hand2);

                    Deal::create([
                        'player1' => $player1,
                        'player2' => $player2,
                        'winner' => $winner,
                    ]);
                }
            }

            fclose($handle);
        } else {
            die("Couldn't read the file");
        }
        return redirect()->to("/results");
    }

    public function results()
    {
        $player1Win = Deal::where('winner', 1)->count();
        $player2Win = Deal::where('winner', 2)->count();
        $draw = Deal::where('winner', 0)->count();
        $wrongInput = Deal::where('winner', -1)->count();
        return view('results', [
            'player1Win' => $player1Win,
            'player2Win' => $player2Win,
            'draw' => $draw,
            'wrongInput' => $wrongInput,
        ]);
    }

    public function clear()
    {
        Deal::truncate();
        return redirect()->to("/results");
    }
}
