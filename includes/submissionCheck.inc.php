<?php
require_once "config.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $data = json_decode(file_get_contents("php://input"), true);

    $date = $data["date"];
    $dayName = $data["dayName"];
    $country = $data["country"];
    $userId = $_SESSION["userId"];

    require_once "../classes/Submission.class.php";

    $newSubmission = new Submission($date, $dayName, $country, $userId);
    $newSubmission->acceptSubmission();
} 
else if ($_SERVER["REQUEST_METHOD"] === "DELETE"){
    $data = json_decode(file_get_contents("php://input"), true);

    $date = $data["date"];
    $dayName = $data["dayName"];
    $country = $data["country"];
    $userId = $_SESSION["userId"];

    require_once "../classes/Submission.class.php";

    $newSubmission = new Submission($date, $dayName, $country, $userId);
    $newSubmission->declineSubmission();
}