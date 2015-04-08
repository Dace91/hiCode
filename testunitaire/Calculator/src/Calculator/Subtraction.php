<?php

namespace Calculator;


class Subtraction implements iOperator
{
    function run($num, $current)
    {
        $r = (($current === 'neutral') ? $num + 0 : $current - $num);

        return $r;
    }

    function getNumber($result)
    {
        $r = (($result === 'neutral') ? 0 : $result);
        return $r;
    }

}