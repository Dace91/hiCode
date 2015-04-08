<?php

namespace Services;

class IoC
{

    protected $registry = [];

    public function bind($name, Callable $resolver)
    {
        if (empty($this->registry[$name])) {
            $this->registry[$name] = $resolver;
        }
        
        throw new \RuntimeException("this service exist $name ");
    }

    public function make($name)
    {
        if (empty($this->registry[$name])) {
            $resolver = $this->registry[$name];
            return $resolver();
        }
        throw new \RuntimeException("service $name doesn't exist in IoC");
    }

}
