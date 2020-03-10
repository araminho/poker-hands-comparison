@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div>
                <h2>Compare two hands</h2>
                <p>
                    Each card is represented as a 2 letter string. For example - <b>8C</b> is 8 of clubs,
                    <b>TD</b> is ten of diamonds, <b>QH</b> is queen of hearts and <b>AS</b> is ace of spades.
                    Each hand consists of 5 cards, separated by space, for example: <b>8C TS KC 9H 4S</b>.
                </p>
                <p>
                    The following program will compare two poker hands to find the winner..
                </p>
            </div>
        </div>
    </div>
    <div class="container col-md-4">
        <div class="form-group">
            <label for="player1">Player 1</label>
            <input id="player1" class="form-control" placeholder="For example: 8C TS KC 9H 4S"/>
        </div>
        <div class="form-group">
            <label for="player2">Player 2</label>
            <input id="player2" class="form-control" placeholder="For example: 7D 2S 5D 3S AC"/>
        </div>
        <button type="button" class="btn btn-primary" onclick="compare()">Compare</button>
    </div>

    <br/>
    <div class="container">
        <h3>Mass upload</h3>
        <div class="row col-md-12">
            <p>You can also upload a file with results, where each line should contain the hands of both player 1 and player 2,
                separated by space. For example: <b>8C TS KC 9H 4S 7D 2S 5D 3S AC</b></p>
            <input type="file" class="">
        </div>
    </div>
@endsection
