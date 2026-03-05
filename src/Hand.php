<?php

namespace App;
use App\EvaluatedHand;

class Hand {

    /** @var Card[] */
    public array $cards = [];

    public function __construct(array $cardStrings)
    {
        foreach ($cardStrings as $cardStr) {
            $this->cards[] = new Card($cardStr);
        }
    }
}