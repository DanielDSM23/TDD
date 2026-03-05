<?php

use PHPUnit\Framework\TestCase;
use App\Hand;

class HandTest extends TestCase {

    public function testHandCreation()
    {
        $hand = new Hand(
            ["As","Ks"], 
            ["Qs","Js","Ts","2d","3c"]
        );

        $this->assertCount(2, $hand->holeCards);
        $this->assertCount(5, $hand->boardCards);
        $this->assertCount(7, $hand->getAllCards());
    }

    
}