<?php


class Router {

  private $routes;

  public function __construct ()
  {
      $routesPath = ROOT.'/config/routes.php';
      $this->routes = include($routesPath);
  }

/*
* RETURNS REQUEST STRING
*/
  private function getURI()
  {
    if (!empty($_SERVER['REQUEST_URI'])) {
      return trim($_SERVER['REQUEST_URI'], '/');
    }
  }

  public function run()
  {
    // GET REQUEST URI
    $uri = $this->getURI();
    // echo $uri;

    // CHECK IF URI EXISTS IN routes.php
    foreach ($this->routes as $uriPattern => $path) {

    //   COMPARE $uriPattern AND $uri
      if (preg_match("~$uriPattern~", $uri)) {

    // GET INTERNALL PATH
    $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

    // DETERMINE WHICH CONTROLLER AND ACTION HANDLE REQUEST
        $segments = explode('/', $internalRoute);
        // print_r($segments);
        // TEST ROUTE DEPENDING ON SERVER SETTINGS
        array_shift($segments); //comment if not necessary
        $controllerName = array_shift($segments).'Controller';
        // echo '<br>controller name: '.$controllerName;
        $controllerName = ucfirst($controllerName);
        // echo '<br>controller name: '.$controllerName;
        $actionName = 'action'.ucfirst(array_shift($segments));

        // echo '<br>controller name: '.$controllerName;
        // echo '<br>action name: '.$actionName;
        $parameters = $segments;

    //CONNECT THE FILE OF CLASS CONTROLLER
        $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

        if (file_exists($controllerFile)) {
          require_once($controllerFile);

    // CREATE OBJECT AND CALL AN ACTION (METHOD)
        $controllerObject = new $controllerName;
        $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
        if ($result != null) {
            break;
          }
        }
      }
    }
  }

}
 ?>
