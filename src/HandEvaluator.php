<?php

namespace App;

class HandEvaluator
{

    public static function evaluate(Hand $hand): EvaluatedHand
    {
        $cards = $hand->getAllCards();
        $combos = self::combinations($cards,5);

        $best = null;

        foreach ($combos as $combo) {

            $eval = self::evaluateFive($combo);

            if ($best === null || $eval->compare($best) > 0) {
                $best = $eval;
            }
        }

        return $best;
    }

    private static function evaluateFive(array $cards): EvaluatedHand
    {
        usort($cards, fn($a,$b)=> $b->rank <=> $a->rank);

        $ranks = array_map(fn($c)=>$c->rank,$cards);
        $suits = array_map(fn($c)=>$c->suit,$cards);

        $counts = array_count_values($ranks);
        arsort($counts);

        $isFlush = count(array_unique($suits)) === 1;
        $straightHigh = self::straightHigh($ranks);

        if ($isFlush && $straightHigh) {
            return new EvaluatedHand($cards,"Straight Flush",[8,$straightHigh]);
        }

        if (in_array(4,$counts)) {

            $quad = array_search(4,$counts);
            $kicker = max(array_diff($ranks,[$quad]));

            return new EvaluatedHand($cards,"Four of a Kind",[7,$quad,$kicker]);
        }

        if (in_array(3,$counts) && in_array(2,$counts)) {

            $trip = array_search(3,$counts);
            $pair = array_search(2,$counts);

            return new EvaluatedHand($cards,"Full House",[6,$trip,$pair]);
        }

        if ($isFlush) {
            return new EvaluatedHand($cards,"Flush",array_merge([5],$ranks));
        }

        if ($straightHigh) {
            return new EvaluatedHand($cards,"Straight",[4,$straightHigh]);
        }

        if (in_array(3,$counts)) {

            $trip = array_search(3,$counts);
            $kickers = array_values(array_diff($ranks,[$trip]));
            rsort($kickers);

            return new EvaluatedHand($cards,"Three of a Kind",
                array_merge([3,$trip],$kickers)
            );
        }

        $pairs = array_keys(array_filter($counts,fn($c)=>$c==2));

        if (count($pairs)==2) {

            rsort($pairs);
            $kicker = max(array_diff($ranks,$pairs));

            return new EvaluatedHand($cards,"Two Pair",
                [2,$pairs[0],$pairs[1],$kicker]
            );
        }

        if (count($pairs)==1) {

            $pair = $pairs[0];
            $kickers = array_values(array_diff($ranks,[$pair]));
            rsort($kickers);

            return new EvaluatedHand($cards,"One Pair",
                array_merge([1,$pair],$kickers)
            );
        }

        return new EvaluatedHand($cards,"High Card",
            array_merge([0],$ranks)
        );
    }

    private static function straightHigh(array $ranks): int|false
    {
        $ranks = array_unique($ranks);
        sort($ranks);

        if ($ranks === [2,3,4,5,14]) {
            return 5;
        }

        if (count($ranks)==5 && $ranks[4]-$ranks[0]==4) {
            return $ranks[4];
        }

        return false;
    }

    private static function combinations($cards,$k)
    {
        $result=[];
        $n=count($cards);

        if($k==0)return [[]];

        for($i=0;$i<=$n-$k;$i++){

            $head=$cards[$i];

            foreach(self::combinations(array_slice($cards,$i+1),$k-1) as $c){
                $result[]=array_merge([$head],$c);
            }
        }

        return $result;
    }
}