<?php

namespace App;

class Card {
    public int $rank;
    public string $suit;
    private static $map = ['T' => 10, 'J' => 11, 'Q' => 12, 'K' => 13, 'A' => 14];

    public function __construct(string $cardStr) {
        $r = $cardStr[0];
        $this->suit = $cardStr[1];
        $this->rank = is_numeric($r) ? (int)$r : self::$map[$r];
    }
}