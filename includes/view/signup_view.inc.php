<?php

function handleSignUpErrors(){
    if (isset($_SESSION["SignupErrors"])){
        $errors = $_SESSION["SignupErrors"];

        foreach ($errors as $error){
            echo "<p style='text-align:center'> An error occured: $error </p>";
        }
            
        unset($_SESSION["SignupErrors"]);
    } 
}