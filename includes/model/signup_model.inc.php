<?php
declare(strict_types = 1);

function findSignedUser(object $pdo, string $username){
    $query = 'SELECT * FROM users WHERE username = :username';

    $stmt = $pdo->prepare($query);
    $stmt->execute([":username" => $username]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;
    return $result;
}

function createUser(object $pdo, string $username, string $pwd){
    $query = 'INSERT INTO users (username, pwd) VALUES (:username, :pwd)';

    $stmt = $pdo->prepare($query);

    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, ['cost' => 12]);

    $stmt->execute([
        ":username" => $username,
        ":pwd" => $hashedPwd
    ]);

    $stmt = null;
}