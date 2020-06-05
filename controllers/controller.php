<?php


class Controller
{
    private $_f3; //router
    private $_validator; //validation object

    /**
     * Controller constructor.
     * @param $f3
     * @param $validator
     */
    public function __construct($f3, $validator)
    {
        $this->_f3 = $f3;
        $this->_validator = $validator;
    }

    /**
     * Display the default route
     */
    public function home()
    {
        //echo '<h1>Dating</h1>';

        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * go to personal form
     */
    public function personal()
    {
        //If the form has been submitted
        $gender = getGender();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //var_dump($_POST);

            //Validate name
            if (!$this->_validator->validName($_POST['first'])) {

                //Set an error variable in the F3 hive
                $this->_f3->set('errors["first"]', "Invalid name");
            }
            if (!$this->_validator->validLname($_POST['last'])) {

                //Set an error variable in the F3 hive
                $this->_f3->set('errors["last"]', "Invalid name");
            }
            if (!$this->_validator->validPhone($_POST['phone'])) {

                //Set an error variable in the F3 hive
                $this->_f3->set('errors["phone"]', "Invalid Phone number");
            }
            if (!$this->_validator->validAge($_POST['age'])) {

                //Set an error variable in the F3 hive
                $this->_f3->set('errors["age"]', "Invalid age: Must be over 18.");
            }
            //Data is valid
            else {
                if(empty($this->_f3->get('errors'))){
                    //Store the data in the session array
                    $_SESSION['first'] = $_POST['first'];
                    $_SESSION['last'] = $_POST['last'];
                    $_SESSION['age'] = $_POST['age'];
                    $_SESSION['gend'] = $_POST['gend'];
                    $_SESSION['phone'] = $_POST['phone'];

                    //Redirect to Order 2 page
                    $this->_f3->reroute('profile');
                }}
        }

        $this->_f3->set('first', $_POST['first']);
        $this->_f3->set('last', $_POST['last']);
        $this->_f3->set('age', $_POST['age']);
        $this->_f3->set('phone', $_POST['phone']);
        $this->_f3->set('gender', $gender);
        $views = new Template();
        echo $views->render('views/personal.html');
    }

    /**
     * go to profile form
     */
    public function profile()
    {
        $gender = getGender();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //var_dump($_POST);

            //Validate email
            if (!$this->_validator->validEmail($_POST['email'])) {
                //Set an error variable in the F3 hive
                $this->_f3->set('errors["email"]', "Invalid email");
            }

            //Data is valid
            else{
                if (empty($this->_f3->get('errors'))) {
                    //Store the data in the session array
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['state'] = $_POST['state'];
                    $_SESSION['seek'] = $_POST['seek'];
                    $_SESSION['bio'] = $_POST['bio'];

                    //Redirect to Order 2 page
                    $this->_f3->reroute('interest');
                }}
        }

        $this->_f3->set('gender', $gender);
        $views = new Template();
        echo $views->render('views/profile.html');
    }

    /**
     * go to interest form
     */
    public function interest()
    {
        $interests = getInterests();
        $outinterests = getOutInterests();
        //If the form has been submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!$this->_validator->validIndoor($_POST['interests'])) {

                //Set an error variable in the F3 hive
                $this->_f3->set('errors["interests"]', "Invalid interest.");
            }
            if (!$this->_validator->validOutdoor($_POST['outinterests'])) {

                //Set an error variable in the F3 hive
                $this->_f3->set('errors["interests"]', "Invalid interest.");
            }
            //Data is valid
            else {
                if (empty($this->_f3->get('errors'))) {

                    //Store the data in the session array
                    $_SESSION['interests'] = $_POST['interests'];
                    $_SESSION['outinterests'] = $_POST['outinterests'];

                    //Redirect to summary page
                    $this->_f3->reroute('summary');
                }}
        }

        $this->_f3->set('interests', $interests);
        $this->_f3->set('outinterests', $outinterests);
        $views = new Template();
        echo $views->render('views/interest.html');
    }

    /**
     * summary page
     */
    public function summary()
    {
        $view = new Template();
        echo $view->render('views/summary.html');

        //session_destroy();
    }
}