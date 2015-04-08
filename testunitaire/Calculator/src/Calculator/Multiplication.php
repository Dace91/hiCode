<?php

namespace Calculator;


class Multiplication implements iOperator
{

    function run($number, $current)
    {
        $r = (($current === 'neutral') ? $number * 1 : $number * $current);
        return $r;
    }

    public function getNumber($result)
    {
        $r = (($result === 'neutral') ? 1 : $result);
        return $r;
    }
}