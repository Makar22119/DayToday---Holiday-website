<?php

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    require_once "../classes/User.class.php";

    $user = new User($username, $pwd);
    $user->logOut();
}