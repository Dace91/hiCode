<?php namespace Tests\Fixtures;

use Library\Storable;

class MockStorage implements Storable
{
    protected $storage;

    public function __construct()
    {
        if (!empty($this->storage)) {
            $this->storage = [];
        }
    }

    /**
     * 
     * @param type $name
     * @param type $value
     */
    public function setValue($name, $value)
    {
        if (empty($this->storage[$name])) {
            $this->storage[$name] = 0;
        }

        $this->storage[$name]+= (float) $value;
        return $this;
    }

    /**
     * 
     * @param type $name
     * @return type
     */
    public function getValue($name)
    {
        if (isset($this->storage[$name])) {
            return $this->storage[$name];
        }
    }

    public function delete($name)
    {
        if (isset($this->storage[$name])) {
            unset($this->storage[$name]);
        }
        return $this;
    }

    public function total()
    {
        if(empty($this->storage)){
            return 0;
        }
        return array_sum($this->storage); 
    }

    public function reset()
    {
        $this->storage = []; 
    }
}
