<?php
require_once "Dbh.class.php";

class User extends Dbh{
    private $username;
    private $pwd;

    public function __construct($username, $pwd){
        $this->username = htmlspecialchars($username);
        $this->pwd = $pwd;
    }

    public function signUp(){
        try {
            require_once '../includes/model/signup_model.inc.php';
            require_once '../includes/controllers/login_controller.inc.php';
            require_once '../includes/controllers/signup_controller.inc.php';

            $errors = [];
            $pdo = parent::connect();

            if (!isSignupDataSubmitted($this->username, $this->pwd))
                $errors['NotEnoughData'] = 'Some data has not been submitted, Please try again';
            
            if (!isUserAvailable($pdo, $this->username))
                $errors['UsernameTaken'] = 'Username is already taken, Please try to enter new username';

            $this->errorHandling("SignupErrors", $errors);

            createUser($pdo, $this->username, $this->pwd);

            $newUser = findSignedUser($pdo, $this->username);
            loginInit($newUser);

            $pdo = null;

            $this->response('Location: ../index.php');    
        } catch (PDOException $e) {
            $this->response("Location: ../form.php", "error: $e");
        }
    }

    public function logIn(){
        try {
            require_once '../includes/model/login_model.inc.php';
            require_once '../includes/controllers/login_controller.inc.php';

            $errors = [];
            $pdo = parent::connect();

            if (!isLoginDataSubmitted($this->username, $this->pwd))
                $errors['NotEnoughData'] = 'Some data has not been submitted, Please try again';
            
            $foundUser = foundUser($pdo, $this->username);
            if (!$foundUser)
                $errors['IncorrectUser'] = 'Username is incorrect, Please try again';
            else if (!validatePwd($this->pwd, $foundUser["pwd"]))
                $errors['IncorrectPwd'] = 'Password is incorrect, Please try again';


            $this->errorHandling("LoginErrors", $errors);

            loginInit($foundUser);

            $pdo = null;

            $this->response('Location: ../index.php');    
        } catch (PDOException $e) {
            $this->response("Location: ../form.php", "error: $e");
        }
    }

    public function logOut(){
        require_once "config.inc.php";

        session_start();
        session_unset();
        session_destroy();

        $this->response("Location: ../index.php");
    }

    private function errorHandling($type, $errors){
        require_once "config.inc.php";

            if ($errors){
                $_SESSION[$type] = $errors;

                $this->response("Location: ../form.php"); 
            }
    }

    private function response($response, $msg = ''){
        Header($response);
        die($msg);   
    }
}