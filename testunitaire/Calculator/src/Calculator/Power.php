<?php

namespace Calculator;


class Power implements iOperator
{

    function run($number, $current)
    {
        $r = (($current === 'neutral') ? $number * 1 :  $current ** $number);
        return $r;
    }

    public function getNumber($result)
    {
        $r = (($result === 'neutral') ? 1 : $result);
        return $r;
    }
}