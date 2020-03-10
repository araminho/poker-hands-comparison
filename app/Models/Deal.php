<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $table = 'deals';

    protected $fillable = [
        'player1',
        'player2',
        'winner',
    ];

    protected $hidden = [];
}
