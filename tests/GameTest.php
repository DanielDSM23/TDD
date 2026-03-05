<?php

use PHPUnit\Framework\TestCase;
use App\Hand;
use App\Game;

class GameTest extends TestCase
{

    public function testDetermineWinner()
    {
        $board=["Ah","Kh","Qh","2c","3d"];

        $players=[
            "Alice"=>new Hand(["Jh","Th"],$board),
            "Bob"=>new Hand(["Ac","Ad"],$board)
        ];

        $winners=Game::determineWinners($players);

        $this->assertEquals(["Alice"],$winners);
    }
}