<?php namespace Card\Library;

class SessionStockage implements Storable
{

    protected $sessionName;

    public function __construct($sessionName = 'products')
    {
        session_start();  // $_SESSION
        if (!isset($_SESSION[$sessionName])) {
            $_SESSION[$sessionName] = [];
        }
        $this->sessionName = $sessionName;
    }

    /**
     * 
     * @param type $name
     * @param type $value
     */
    public function setValue($name, $value)
    {
        if (!isset($_SESSION[$this->sessionName][$name])) {
            $_SESSION[$this->sessionName][$name] = 0;
        }

        $_SESSION[$this->sessionName][$name]+=(float) $value;
        return $this;
    }

    /**
     * 
     * @param type $name
     * @return type
     */
    public function getValue($name)
    {
        if (isset($_SESSION[$this->sessionName][$name])) {
            return $_SESSION[$this->sessionName][$name];
        }
    }

    public function delete($name)
    {
        if (isset($_SESSION[$this->sessionName][$name])) {
            unset($_SESSION[$this->sessionName][$name]);
        }
        return $this;
    }

    public function total()
    {
        return array_sum($_SESSION[$this->sessionName]); // fait la somme des valeurs du tableau associatif
    }

    public function reset()
    {
        $_SESSION[$this->sessionName] = []; // ré-initialise le tableau
    }

}
