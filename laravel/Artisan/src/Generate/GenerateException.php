<?php namespace Tony\Console\Commands\Generate;

class GenerateException extends \Exception
{

    public function __construct($message, $code = 0, Exception $previous = null)
    {

        parent::__construct($message, $code, $previous);

    }
}