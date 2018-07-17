<?php


class Router {

  private $routes;

  public function __construct ()
  {
      $routesPath = ROOT.'/config/routes.php';
      // echo $routesPath."<br>";
      $this->routes = include($routesPath);

  }

/*
* RETURNS REQUEST STRING
*/
  private function getURI()
  {
    if (!empty($_SERVER['REQUEST_URI'])) {
      return trim($_SERVER['REQUEST_URI']);
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

    // DETERMINE WHICH CONTROLLER AND ACTION HANDLE REQUEST
        $segments = explode('/', $path);
        $controllerName = ucfirst(array_shift($segments).'Controller');
        $actionName = 'action'.ucfirst(array_shift($segments));

    //CONNECT THE FILE OF CLASS CONTROLLER
        $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
        if (file_exists($controllerFile)) {
          require_once($controllerFile);

    // CREATE OBJECT AND CALL AN ACTION (METHOD)
        $controllerObject = new $controllerName;
        $result = $controllerObject->actionName;
        if ($resul != null) {
            break;
          }
        }
      }
    }
  }

}
 ?>
