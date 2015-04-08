<?php namespace Library;

interface Storable
{
    function setValue($name, $price);
    function getValue($name);
    function delete($name);
    function reset();
    function total();
}
