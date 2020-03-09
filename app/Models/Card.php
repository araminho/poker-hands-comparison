<?php
/**
 * Created by PhpStorm.
 * User: aram.hovhannisyan
 * Date: 09/03/2020
 * Time: 11:29
 */

namespace App\Models;


class Card
{
    private $suit;
    private $nominal;
    private $value;

    public static $suits = [
        'C' => 'Clubs',
        'D' => 'Diamonds',
        'H' => 'Hearts',
        'S' => 'Spades',
    ];

    public static $values = [
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        'T' => 10,
        'J' => 11,
        'Q' => 12,
        'K' => 13,
        'A' => 14,
    ];

    public function __construct($str)
    {
        if (strlen($str) == 2 && array_key_exists($str[0], self::$values) && array_key_exists($str[1], self::$suits)) {
            $this->nominal = $str[0];
            $this->suit = $str[1];
            $this->value = self::$values[$str[0]];
        }
    }

    public function getSuit()
    {
        return $this->suit;
    }

    public function getValue()
    {
        return $this->value;
    }
}