<?php


//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


//Require the autoload file
require_once("vendor/autoload.php");
require_once ("model/data-layer.php");
//require_once("model/data-validation.php");

//Start a session
session_start();

//Instantiate the F3 Base class
$f3 = Base::instance();
//Instantiate my classes
$validator = new validation();
$controller = new Controller($f3, $validator);

//Default route
$f3->route('GET /', function() {
    $GLOBALS['controller']->home();
});

//personal route
$f3->route('GET|POST /personal', function (){
    $GLOBALS['controller']->personal();
});

//profile route
$f3->route('GET|POST /profile', function(){
    $GLOBALS['controller']->profile();
});

//interest route
$f3->route('GET|POST /interest', function(){
    $GLOBALS['controller']->interest();
});

//summary
$f3->route('GET /summary', function() {
    $GLOBALS['controller']->summary();
});

//Run F3
$f3->run();