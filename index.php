<?php
//Start a session
session_start();

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);



//Require the autoload file
require_once("vendor/autoload.php");
require_once ("model/data-layer.php");

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
    $gender = getGender();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

            //Store the data in the session array
            $_SESSION['first'] = $_POST['first'];
            $_SESSION['last'] = $_POST['last'];
            $_SESSION['age'] = $_POST['age'];
            $_SESSION['gend'] = $_POST['gend'];
            $_SESSION['phone'] = $_POST['phone'];

            //Redirect to Order 2 page
            $f3->reroute('profile');

    }

    //$f3->set('first', $_POST['first']);
    $f3->set('gender', $gender);
    $views = new Template();
    echo $views->render('views/personal.html');
});

//profile route
$f3->route('GET|POST /profile', function($f3){

    $gender = getGender();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

        //Store the data in the session array
       $_SESSION['email'] = $_POST['email'];
       $_SESSION['state'] = $_POST['state'];
       $_SESSION['seek'] = $_POST['seek'];
       $_SESSION['bio'] = $_POST['bio'];

        //Redirect to Order 2 page
        $f3->reroute('interest');

    }

    $f3->set('gender', $gender);
    $views = new Template();
    echo $views->render('views/profile.html');
});

//interest route
$f3->route('GET|POST /interest', function($f3){

    $interests = getInterests();
    $outinterests = getOutInterests();
    //If the form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Store the data in the session array
        $_SESSION['interests'] = $_POST['interests'];
        $_SESSION['outinterests'] = $_POST['outinterests'];
        //Redirect to summary page
        $f3->reroute('summary');

    }

    $f3->set('interests', $interests);
    $f3->set('outinterests', $outinterests);
    $views = new Template();
    echo $views->render('views/interest.html');
});

//summary
$f3->route('GET /summary', function() {

    $view = new Template();
    echo $view->render('views/summary.html');

    //session_destroy();
});

//Run F3
$f3->run();