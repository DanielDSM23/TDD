<?php

use PHPUnit\Framework\TestCase;
use App\Hand;
use App\HandEvaluator;

class HandEvaluatorTest extends TestCase {

    public function testFlushFromBoardAndHoleCards()
    {
        $board = ["As","Ks","8s","2d","3c"];

        $hand = new Hand(
            ["Js","4s"],
            $board
        );

        $result = HandEvaluator::evaluate($hand);

        $this->assertEquals("Flush", $result->category);
    }

    public function testDetermineBestFiveCardsFromSeven()
    {
        $board = ["Jh","8h","4h","3h","2h"];

        $hand = new Hand(
            [], 
            $board
        );

        $result = HandEvaluator::evaluate($hand);

        $this->assertEquals("Flush", $result->category);

        $this->assertCount(5, $result->cards);

        $ranks = array_map(fn($c) => $c->rank, $result->cards);
        sort($ranks);

        $this->assertEquals([2, 3, 4, 8, 11], $ranks);
    }

}