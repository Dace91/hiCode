<?php

namespace Calculator;


class Addition implements iOperator
{

    function run($number, $current)
    {
        $r=  (($current === 'neutral') ? $number + 0 : $number + $current);
        return $r;
    }

    public function getNumber($result)
    {
        $r= (($result === 'neutral') ? 0 : $result);
        return $r;
    }

}