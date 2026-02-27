<?php

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_REQUEST["username"];
    $pwd = $_REQUEST["pwd"];

    require_once "../classes/User.class.php";

    $user = new User($username, $pwd);
    $user->logIn();
}