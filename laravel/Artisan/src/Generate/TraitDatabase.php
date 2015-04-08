<?php namespace Tony\Console\Commands\Generate;


trait TraitDatabase
{

    protected $fields = ['s' => 'string', 't' => 'timestamp', 'e' => 'emum', 'i' => 'integer'];

    protected $dirDatabase;

    protected function getField($name)
    {
        return (isset($this->fields[$name]) ? $this->fields[$name] : $name);
    }


    public function getDirDatabase()
    {
        return dirname(app_path()) . self::DS . 'database';
    }
}

