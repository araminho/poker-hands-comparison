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

    private $high1 = false;
    private $high2 = false;
    private $high3 = false;
    private $high4 = false;
    private $high5 = false;

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

    // Sort the hand by descending order using Bubble sort
    public function normalize()
    {
        $normalized = $this->getCards();
        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 4 - $i; $j++) {
                if ($normalized[$j + 1]->getValue() > $normalized[$j]->getValue()) {
                    list($normalized[$j], $normalized[$j + 1]) = array($normalized[$j + 1], $normalized[$j]);
                }
            }
        }
        $this->cards = $normalized;
    }

    /* ---- Check if the hand one of the winning hands ---*/
    /* ---- All methods should be used after normalizing ---- */

    public function isRoyalFlush()
    {
        return $this->isStraightFlush() && $this->high1 == Card::$values['A'];
    }

    public function isStraightFlush()
    {
        return $this->isStraight() && $this->isFlush();
    }

    public function isFourOfAKind()
    {
        $cards = $this->getCards();
        // First four are equal
        if ($cards[0]->getValue() == $cards[1]->getValue() &&
            $cards[1]->getValue() == $cards[2]->getValue() &&
            $cards[2]->getValue() == $cards[3]->getValue()
        ) {
            $this->high1 = $cards[0]->getValue();
            return true;
        }
        // Last four cards are equal
        else if ($cards[1]->getValue() == $cards[2]->getValue() &&
            $cards[2]->getValue() == $cards[3]->getValue() &&
            $cards[3]->getValue() == $cards[4]->getValue()) {
            $this->high1 = $cards[1]->getValue();
            return true;
        }
        return false;
    }

    public function isFullHouse()
    {
        $cards = $this->getCards();
        // First three and last two are equal or vice-versa
        if ($cards[0]->getValue() == $cards[1]->getValue() &&
            $cards[1]->getValue() == $cards[2]->getValue() &&
            $cards[3]->getValue() == $cards[4]->getValue()
        ) {
            $this->high1 = $cards[0]->getValue();
            $this->high2 = $cards[3]->getValue();
            return true;
        } else if ($cards[0]->getValue() == $cards[1]->getValue() &&
            $cards[2]->getValue() == $cards[3]->getValue() &&
            $cards[3]->getValue() == $cards[4]->getValue()
        ) {
            $this->high1 = $cards[0]->getValue();
            $this->high2 = $cards[2]->getValue();
            return true;
        }
        return false;
    }

    public function isFlush()
    {
        $cards = $this->getCards();
        // All have the same suits
        if ($cards[0]->getSuit() == $cards[1]->getSuit() &&
            $cards[1]->getSuit() == $cards[2]->getSuit() &&
            $cards[2]->getSuit() == $cards[3]->getSuit() &&
            $cards[3]->getSuit() == $cards[4]->getSuit()
        ) {
            return true;
        }
        return false;
    }

    public function isStraight()
    {
        $cards = $this->getCards();
        if ($cards[0]->getValue() - $cards[1]->getValue() == 1 &&
            $cards[1]->getValue() - $cards[2]->getValue() == 1 &&
            $cards[2]->getValue() - $cards[3]->getValue() == 1 &&
            $cards[3]->getValue() - $cards[4]->getValue() == 1
        ) {
            $this->high1 = $cards[0]->getValue();
            return true;
        }
        return false;
    }

    public function isThreeOfAKind()
    {
        $cards = $this->getCards();
        // First three are equal or middle three are equal or last three are equal
        if ($cards[0]->getValue() == $cards[1]->getValue() && $cards[1]->getValue() == $cards[2]->getValue()) {
            $this->high1 = $cards[0]->getValue();
            $this->high2 = $cards[3]->getValue();
            $this->high3 = $cards[4]->getValue();
            return true;
        } else if ($cards[1]->getValue() == $cards[2]->getValue() && $cards[2]->getValue() == $cards[3]->getValue()) {
            $this->high1 = $cards[1]->getValue();
            $this->high2 = $cards[0]->getValue();
            $this->high3 = $cards[4]->getValue();
            return true;
        } else if ($cards[2]->getValue() == $cards[3]->getValue() && $cards[3]->getValue() == $cards[4]->getValue()) {
            $this->high1 = $cards[2]->getValue();
            $this->high2 = $cards[0]->getValue();
            $this->high3 = $cards[1]->getValue();
            return true;
        }
        return false;
    }

    public function isTwoPairs()
    {
        $cards = $this->getCards();
        // First and second are equal, third and fourth are equal
        if ($cards[0]->getValue() == $cards[1]->getValue() && $cards[2]->getValue() == $cards[3]->getValue()) {
            $this->high1 = $cards[0]->getValue();
            $this->high2 = $cards[2]->getValue();
            $this->high3 = $cards[4]->getValue();
            return true;
        } // First and second are equal, fourth and fifth are equal
        else if ($cards[0]->getValue() == $cards[1]->getValue() && $cards[3]->getValue() == $cards[4]->getValue()) {
            $this->high1 = $cards[0]->getValue();
            $this->high2 = $cards[3]->getValue();
            $this->high3 = $cards[2]->getValue();
            return true;
        } // Second and third are equal, fourth and fifth are equal
        else if ($cards[1]->getValue() == $cards[2]->getValue() && $cards[3]->getValue() == $cards[4]->getValue()) {
            $this->high1 = $cards[1]->getValue();
            $this->high2 = $cards[3]->getValue();
            $this->high3 = $cards[0]->getValue();
            return true;
        }
        return false;
    }

    public function isOnePair()
    {
        $cards = $this->getCards();
        // First and second are equal
        if ($cards[0]->getValue() == $cards[1]->getValue()) {
            $this->high1 = $cards[0]->getValue();
            $this->high2 = $cards[2]->getValue();
            $this->high3 = $cards[3]->getValue();
            $this->high4 = $cards[4]->getValue();
            return true;
        } // Second and third are equal
        else if ($cards[1]->getValue() == $cards[2]->getValue()) {
            $this->high1 = $cards[1]->getValue();
            $this->high2 = $cards[0]->getValue();
            $this->high3 = $cards[3]->getValue();
            $this->high4 = $cards[4]->getValue();
            return true;
        } // Third and fourth are equal
        else if ($cards[2]->getValue() == $cards[3]->getValue()) {
            $this->high1 = $cards[2]->getValue();
            $this->high2 = $cards[0]->getValue();
            $this->high3 = $cards[1]->getValue();
            $this->high4 = $cards[4]->getValue();
            return true;
        } // Fourth and fifth are equal
        else if ($cards[3]->getValue() == $cards[4]->getValue()) {
            $this->high1 = $cards[3]->getValue();
            $this->high2 = $cards[0]->getValue();
            $this->high3 = $cards[1]->getValue();
            $this->high4 = $cards[2]->getValue();
            return true;
        }
        return false;
    }

    public function allAreDifferent()
    {
        $cards = $this->getCards();
        if ($cards[0]->getValue() - $cards[1]->getValue() != 0 &&
            $cards[1]->getValue() - $cards[2]->getValue() != 0 &&
            $cards[2]->getValue() - $cards[3]->getValue() != 0 &&
            $cards[3]->getValue() - $cards[4]->getValue() != 0
        ) {
            $this->high1 = $cards[0]->getValue();
            $this->high2 = $cards[1]->getValue();
            $this->high3 = $cards[2]->getValue();
            $this->high4 = $cards[3]->getValue();
            $this->high5 = $cards[4]->getValue();
            return true;
        }
        return false;
    }

    public function getWinningHandPriority()
    {
        $this->normalize();
        if ($this->isRoyalFlush()) {
//            echo "Royal flush! <br/>";
            return 1;
        } else if ($this->isStraightFlush()) {
//            echo "Straight flush! <br/>";
            return 2;
        } else if ($this->isFourOfAKind()) {
//            echo "Four of a kind! <br/>";
            return 3;
        } else if ($this->isFullHouse()) {
//            echo "Full house! <br/>";
            return 4;
        } else if ($this->isFlush()) {
//            echo "Flush! <br/>";
            return 5;
        } else if ($this->isStraight()) {
//            echo "Straight! <br/>";
            return 6;
        } else if ($this->isThreeOfAKind()) {
//            echo "Three of a kind! <br/>";
            return 7;
        } else if ($this->isTwoPairs()) {
//            echo "Two pairs! <br/>";
            return 8;
        } else if ($this->isOnePair()) {
//            echo "One pair of $this->high1! <br/>";
            return 9;
        } else {
            $this->allAreDifferent();       // set high1, high2, ... properties
            /*$valuesToNominals = array_flip(Card::$values);
            $nominal = $valuesToNominals[$this->high1];
            echo "All are different. Highest is $nominal <br/>";*/
            return 10;
        }
    }


    public function isValid()
    {
        return count($this->getCards()) == 5;
    }

    /**
     * Returns 1 if hand1 wins, 2 if hand2 wins, and 0 if it's draw
     * @param Hand $hand1
     * @param Hand $hand2
     * @return Int
     */
    public static function compareHands($hand1, $hand2)
    {
        if (!$hand1->isValid() || !$hand2->isValid()){
            return -1;
        }
        $p1 = $hand1->getWinningHandPriority();
        $p2 = $hand2->getWinningHandPriority();
        // Winning hands are different
        if ($p1 < $p2) {
            return 1;
        } else if ($p1 > $p2) {
            return 2;
        }

        // Winning hands are the same, need to compare highest cards
        if ($hand1->high1 > $hand2->high1) {
            return 1;
        } else if ($hand1->high1 < $hand2->high1) {
            return 2;
        }

        if ($hand1->high2 > $hand2->high2) {
            return 1;
        } else if ($hand1->high2 < $hand2->high2) {
            return 2;
        }

        if ($hand1->high3 > $hand2->high3) {
            return 1;
        } else if ($hand1->high3 < $hand2->high3) {
            return 2;
        }

        if ($hand1->high4 > $hand2->high4) {
            return 1;
        } else if ($hand1->high4 < $hand2->high4) {
            return 2;
        }

        if ($hand1->high5 > $hand2->high5) {
            return 1;
        } else if ($hand1->high5 < $hand2->high5) {
            return 2;
        }

        return 0;
    }
}