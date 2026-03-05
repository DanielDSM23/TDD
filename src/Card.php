<?php

namespace App;

class Card {
    public int $rank;
    public string $suit;

    public function __construct(string $cardStr) {
        $r = strtoupper($cardStr[0]);
        $map = ['T' => 10, 'J' => 11, 'Q' => 12, 'K' => 13, 'A' => 14];
        $this->rank = $map[$r] ?? (int)$r;
        $this->suit = strtolower($cardStr[1]);
    }
}