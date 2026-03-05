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

}