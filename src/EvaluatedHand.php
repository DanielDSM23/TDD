<?php

namespace App;

class EvaluatedHand {

    public array $cards;
    public string $category;
    public int $score;

    public function __construct(array $cards, string $category, int $score)
    {
        $this->cards = $cards;
        $this->category = $category;
        $this->score = $score;
    }
}