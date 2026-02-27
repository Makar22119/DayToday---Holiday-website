<?php
require_once "Dbh.class.php";

class Submission extends Dbh{
    private $date;
    private $dayName;
    private $country;
    private $userId;

    public function __construct($date, $dayName, $country, $userId){
        $this->date = $date;
        $this->dayName = htmlspecialchars($dayName);
        $this->country = htmlspecialchars($country);
        $this->userId = $userId;
    }

    public function publish(){
        try {
            require_once '../includes/model/submit_model.inc.php';
            require_once '../includes/controllers/submit_controller.inc.php';
            
            $errors = [];
            $pdo = parent::connect();

            if (!isDataSubmitted($this->date, $this->dayName, $this->country))
                 $errors['NotEnoughData'] = 'Some data has not been submitted, Please try again';
            
            if (!isSubmissionAvailable($pdo, $this->dayName, $this->country))
                 $errors['SubmissionTaken'] = 'Such submission has already been submitted';

            if (!isDayAvailable($pdo, $this->dayName, $this->country))
                 $errors['DayTaken'] = 'Such day already exists in the site';

            $this->errorHandling($errors);

            postSubmission($pdo, $this->date, $this->dayName, $this->country, $this->userId);
        
            $pdo = null;

            $this->response("Location: ../submitForm.php?result=added");
        } catch (PDOException $e) {
            $this->response("Location: ../submitForm.php", "error: $e");
        }
    }

    public function acceptSubmission(){
        try{
            require_once '../includes/model/submissionCheck_model.inc.php';
            require_once '../includes/controllers/submissionCheck_controller.inc.php';

            $pdo = parent::connect();

            if (isPermissionGranted($pdo, $this->userId))
                insertSubmission($pdo, $this->date, $this->dayName, $this->country, 'accepted');

            $pdo = null;
            $this->response("Location: ../submissions.php");
        } catch (PDOException $e) {
            $this->response("Location: ../submissions.php", "error: $e");
        }
    }

    public function declineSubmission(){
        try{
            require_once '../includes/model/submissionCheck_model.inc.php';
            require_once '../includes/controllers/submissionCheck_controller.inc.php';

            $pdo = parent::connect();

            if (isPermissionGranted($pdo, $this->userId))
                deleteSubmission($pdo, $this->date, $this->dayName, $this->country, 'rejected');

            $pdo = null;
            $this->response("Location: ../submissions.php");
        } catch (PDOException $e) {
            $this->response("Location: ../submissions.php", "error: $e");
        }
    }

    private function errorHandling($errors){
        require_once "config.inc.php";

            if ($errors){
                $_SESSION["SubmissionErrors"] = $errors;

                $this->response("Location: ../submitForm.php"); 
            }
    }

    private function response($response, $msg = ''){
        Header($response);
        die($msg);   
    }
}