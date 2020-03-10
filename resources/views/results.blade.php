@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Results</h1>
        <p><b>Player 1 won:</b> {{$player1Win}}</p>
        <p><b>Player 2 won:</b> {{$player2Win}}</p>
        <p><b>Draw: </b> {{$draw}}</p>
        <p><b>Wrong input: </b> {{$wrongInput}}</p>

        <a href="{{route('clear')}}" class="btn btn-danger">Clear Results</a>
        <a href="{{route('home')}}" class="btn btn-primary">Back</a>
    </div>
@endsection
