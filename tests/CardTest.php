<?php

use PHPUnit\Framework\TestCase;
use App\Card;

class CardTest extends TestCase {

    // Tester les cartes : As de pique dans ce cas
    public function testCardParsing() {
        $card = new Card("As");
        $this->assertEquals(14, $card->rank);
        $this->assertEquals('s', $card->suit);
    }
}