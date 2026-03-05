<?php

namespace App;

class Hand {

    /** @var Card[] */
    public array $holeCards = [];

    /** @var Card[] */
    public array $boardCards = [];

    public function __construct(array $holeCards, array $boardCards)
    {
        foreach ($holeCards as $c) {
            $this->holeCards[] = new Card($c);
        }

        foreach ($boardCards as $c) {
            $this->boardCards[] = new Card($c);
        }
    }

    public function getAllCards(): array
    {
        return array_merge($this->holeCards, $this->boardCards);
    }
}