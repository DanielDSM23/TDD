<?php

namespace App;

class Card {
    public int $rank;
    public string $suit;

    public function __construct(string $cardString) {
        $r = substr($cardString, 0, -1);
        $this->suit = substr($cardString, -1);
        $map = ['T' => 10, 'J' => 11, 'Q' => 12, 'K' => 13, 'A' => 14];
        $this->rank = isset($map[$r]) ? $map[$r] : (int)$r;
    }
}