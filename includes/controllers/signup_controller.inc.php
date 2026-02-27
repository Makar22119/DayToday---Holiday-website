<?php
declare(strict_types = 1);

function isSignupDataSubmitted(string $username, string $pwd){
    return ($username && $pwd);
}

function isUserAvailable(object $pdo, string $username){
    return !findSignedUser($pdo, $username);
}
