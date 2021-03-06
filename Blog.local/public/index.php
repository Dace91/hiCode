<?php

require __DIR__ . '/../bootstrap.php';

/**
 *  dans les conditions vous avez les routes de notre application, on utilise une expression régulière pour analyser la route
 *  
 */
try {
    
    $routing = $router->getRoute(URI);

    if (empty($routing)) {
        throw new RuntimeException("bad route");
    }
    
    $controllerName = $routing['controller'];
    $action = $routing['action'];

    // class ReflectionClass permet de savoir comment une classe donnée est faite
    $reflController = new ReflectionClass($controllerName);
    if (!$reflController->hasMethod($action)) {
        throw new RuntimeException("bad route");
    }
    $controller = new $controllerName;
    $params = (!empty($routing['params']))? $routing['params'] : [];
    
    call_user_func_array(array($controller, $action), $params);
    
} catch (RuntimeException $ex) {
    
    header('Status: 404 Not Found');
    echo '<html><body><h1>Page Not'.$ex->getMessage().' Found</h1></body></html>';
    
}