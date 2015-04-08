<?php

namespace Services;

class View
{

    protected $layout;

    public function getLayout()
    {
        return $this->layout;
    }

    public function setLayout($layout)
    {
        $this->layout = (string) $layout;
    }

    /**
     * method render
     * 
     * @param string $path
     * @param array $data
     * @return view
     */
    public function render($path, $data = [])
    {

        $fileName = $this->getPath($path);

        extract($data);

        ob_start();
        include $fileName;
        $content = ob_get_contents();
        ob_end_clean();
        
        if (!is_null($this->layout)) {
            ob_start();
            $layout = $this->getPath($this->layout);
            include $layout;
            $content = ob_get_contents();
            ob_end_clean();
        }
        
        echo $content;
    }

    public function getPath($path)
    {
        $fileName = URL_VIEWS . "/" . preg_replace('/\./', "/", $path) . ".php";

        if (!file_exists($fileName)) {
            throw new \RuntimeException("bad view ");
        }

        return $fileName;
    }

}
