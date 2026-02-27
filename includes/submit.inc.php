<?php
require_once "config.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $date = $_REQUEST['date'];
    $dayName = $_REQUEST["dayName"];
    $country = $_REQUEST["country"];
    $userId = $_SESSION["userId"];

    require_once "../classes/Submission.class.php";

    $newSubmission = new Submission($date, $dayName, $country, $userId);
    $newSubmission->publish();
}