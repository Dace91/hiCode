<?php namespace Tony\Console\Commands\Generate;

use Illuminate\Console\Command;

class MakeModel extends AbstractGenerate
{


    public function make($resource)
    {

        $className = $this->normalize($resource);

        $model = app_path() . self::DS . $className;

        if (!$this->file->exists($model)) return true;

    }

    public function getModelName($name)
    {
        return $this->normalize($name);
    }


}