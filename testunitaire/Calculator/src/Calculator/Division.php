<?php

namespace Calculator;


class Division implements iOperator
{

    function run($number, $current)
    {
        if ($number == 0) {
            throw new \InvalidArgumentException('division by zero impossible!');
        }
        $r = (($current === 'neutral') ? $number * 1 : $current / $number);
        return $r;
    }

    public function getNumber($result)
    {
        $r = (($result === 'neutral') ? 1 : $result);
        return $r;
    }
}