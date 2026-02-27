<?php
declare(strict_types = 1);

function getUsersInbox(object $pdo, int $userId){
    $query = "SELECT * FROM inbox WHERE userId = :userId";

    $stmt = $pdo->prepare($query);
    $stmt->execute([":userId" => $userId]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = null;
    return $result;
}