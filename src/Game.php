<?php

namespace App;

class Game
{
    public static function determineWinners(array $players): array
    {
        $results=[];

        foreach($players as $name=>$hand){
            $results[$name]=HandEvaluator::evaluate($hand);
        }

        $best=null;

        foreach($results as $r){
            if($best===null || $r->compare($best)>0){
                $best=$r;
            }
        }

        return array_keys(
            array_filter($results,fn($r)=>$r->compare($best)==0)
        );
    }
}
