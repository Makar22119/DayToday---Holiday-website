<?php

function handleLoginErrors(){
    if (isset($_SESSION["LoginErrors"])){
        $errors = $_SESSION["LoginErrors"];

        foreach ($errors as $error){
            echo "<p style='text-align:center'> An error occured: $error </p>";
        }
            
        unset($_SESSION["LoginErrors"]);
    } 
}

function isUserAllowed(){
    if (isset($_SESSION["userId"])) header('Location: index.php');
}