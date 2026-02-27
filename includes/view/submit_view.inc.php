<?php

function handleSubmitErrors(){
    if (isset($_SESSION["SubmissionErrors"])){
        $errors = $_SESSION["SubmissionErrors"];

        echo '<br>';
        foreach ($errors as $error){
            echo "<p style='font-size: min(1rem, 2vw)'> An error occured: $error </p>";
        }
            
        unset($_SESSION["SubmissionErrors"]);
    } 
    else if (isset($_GET["result"]) && $_GET["result"] === "added"){
        echo "<p style='font-size: min(3rem, 4vw)'>Your submission has been <span style='color: var(--clr-green-text)'>sent!</span></p>";
    } 
}

function isUserAllowed(){
    if (!isset($_SESSION["userId"])) header('Location: index.php');
}