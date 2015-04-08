<?php

namespace Calculator;


interface iOperator
{
    function run($num, $current);

    function getNumber($number);

}