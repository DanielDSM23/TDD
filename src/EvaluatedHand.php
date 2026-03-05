<?php

namespace App;

class EvaluatedHand
{
    public array $cards;
    public string $category;
    public array $score;

    public function __construct(array $cards, string $category, array $score)
    {
        $this->cards = $cards;
        $this->category = $category;
        $this->score = $score;
    }

    public function compare(EvaluatedHand $other): int
    {
        return $this->score <=> $other->score;
    }
}