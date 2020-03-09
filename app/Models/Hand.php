<?php
/**
 * Created by PhpStorm.
 * User: aram.hovhannisyan
 * Date: 09/03/2020
 * Time: 11:32
 */

namespace App\Models;


class Hand
{
    private $cards = [];

    public function __construct($handsString)
    {
        $cardStrings = explode(' ', $handsString);
        if (count($cardStrings) == 5) {
            $cards = [];
            foreach ($cardStrings as $str) {
                $cards[] = new Card($str);
            }
            $this->cards = $cards;
        }
    }

    public function getCards()
    {
        return $this->cards;
    }

    // Sort the hand by descending order
    public function normalize()
    {
        $normalized = $this->cards;
        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 4 - $i; $j++) {
                if ($normalized[$j + 1]->getValue() > $normalized[$j]->getValue()){
                    list($normalized[$j], $normalized[$j + 1]) = array($normalized[$j + 1], $normalized[$j]);
                }
            }
        }
        $this->cards = $normalized;
    }
}