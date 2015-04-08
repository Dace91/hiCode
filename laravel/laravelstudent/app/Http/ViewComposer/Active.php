<?php namespace App\Http\ViewComposer;

class Active
{

    protected $request;
    protected $pos = ['slug' => 1, 'id' => 2];

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function isHome()
    {
        if ($this->request->is('/')) return true;

        return false;
    }

    /**
     * call method is[Term] 
     * 
     * @param $name
     * @param $arguments
     * @return bool
     */
    public function __call($name, $arguments)
    {
        if ((count($arguments) != 1) || strpos($name, 'is'))
            throw new \RuntimeException(sprintf('error syntax name %s or bad number argument', $name));

        $slug = strtolower(substr($name, 2));

        $id = (int)$arguments[0];

        if ($slug == $this->request->segment($this->pos['slug']) && $this->request->segment($this->pos['id']) == $id)
            return true;

        return false;
    }

    /**
     * @param array $pos
     */
    public function setPos(array $pos)
    {
        $this->pos = $pos;
    }

}