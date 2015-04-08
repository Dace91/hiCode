<?php

namespace Tests\Fixtures;

/**
 * Description of Service
 *
 * @author antoine
 */
class Service
{
    public $param;
    
    public function __construct($param)
    {
        $this->param= (int) $param;
    }
}
