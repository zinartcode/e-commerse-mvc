<?php

//FRONT CONTROLLER



// 1. SETUP
ini_set('display errors', 1);
error_reporting(E_ALL);

// 2. CONNECT FILES

define ('ROOT', dirname(__FILE__));
// echo ROOT."<br>";
require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/Db.php');

// 3. CONNECT DATABASE


// 4. CALLING ROUTER
$router = new Router();
$router->run();

 ?>
