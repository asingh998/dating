<!--
Arshdeep Singh
4/22/10
config file
-->
<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once("vendor/autoload.php");

//Instantiate the F3 Base class
$f3 = Base::instance();

//Default route
$f3->route('GET /', function() {
    //echo '<h1>Dating.</h1>';

   $views = new Template();
   echo $views->render('views/home.html');
});

//personal route
$f3->route('GET|POST /personal', function ($f3){
    //If the form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        var_dump($_POST);

        //Data is valid
        if (empty($f3->get('errors'))) {

            //Store the data in the session array
            $_SESSION['first'] = $_POST['first'];

            //Redirect to Order 2 page
            $f3->reroute('profile');
        }
    }

    $f3->set('first', $_POST['first']);
    $views = new Template();
    echo $views->render('views/personal.html');
});

//profile route
$f3->route('GET|POST /profile', function(){

    $views = new Template();
    echo $views->render('views/profile.html');
});

//interest route
$f3->route('GET|POST /interest', function(){

    $views = new Template();
    echo $views->render('views/interest.html');
});

//summary
$f3->route('GET /summary', function() {

    $view = new Template();
    echo $view->render('views/summary.html');

    session_destroy();
});

//Run F3
$f3->run();