<?php
declare(strict_types = 1);

function findUser(object $pdo, string $username){
    $query = "SELECT * FROM users WHERE username = :username";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ":username" => $username
    ]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $pdo = null;
    return $result;
}