<?php

namespace Services\Router;

/**
 * Description of Router
 *
 * @author antoine
 */
class Router implements \Countable
{

    protected $routes = [];

    /**
     * 
     * @param array $routes
     * @throws \RuntimeException
     */
    public function addRoute(array $routes)
    {
        foreach ($routes as $route => $info) {

            if (isset($this->routes[$route])) {
                throw new \RuntimeException(\sprintf('Cannot override route "%s".', $route));
            }

            $this->routes[$route] = $info;
        }
    }

    /**
     * 
     * @param type $url
     */
    public function getRoute($url)
    {
        $routing = [];
        foreach ($this->routes as $route) {
            if (preg_match('/^' . $route['pattern'] . '$/', $url)) {

                list($controller, $action) = explode(':', $route['connect']);

                $routing = [
                    'controller' => $controller,
                    'action' => $action,
                    'params' => $this->getParams($route, $matches)
                ];

                return $routing;
            }
        }
        
        throw new \RuntimeException("bad route exception");
    }

    /**
     * 
     * @param array $params
     * @param array $matches
     * @return array
     */
    public function getParams(array $params, array $matches)
    {

        if (empty($params['params'])) {
            return;
        }

        foreach (explode(',', $params['params']) as $p) {
            $p= trim($p);
            $values[$p] = $matches[$p];
        }
        return $values;
    }

    public function count()
    {
        return count($this->routes);
    }

}
