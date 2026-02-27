<?php
declare(strict_types = 1);

function isLoginDataSubmitted(string $username, string $pwd){
    return ($username && $pwd);
}

function foundUser(object $pdo, string $username){
    return findUser($pdo, $username);
}

function validatePwd(string $pwd, string $hashedPwd){
    return password_verify($pwd, $hashedPwd);
}

function loginInit(array $user){
    if ($user){
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . '_' . $user["id"];
        session_id($sessionId);

        $_SESSION["userId"] = $user["id"];
        $_SESSION["userUsername"] = htmlspecialchars($user["username"]);
        $_SESSION['last_regeneration'] = time();
    }
}