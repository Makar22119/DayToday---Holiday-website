<?php
declare(strict_types = 1);

function getSubmissions(object $pdo, int $userId){
    if (isPermissionGranted($pdo, $userId)){
        $query = "SELECT * FROM submissions";

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        return $result;
    } else header('Location: index.php');
}

function checkUserRoles(object $pdo, int $userId){
    $query = "SELECT roles FROM users WHERE id = :userId";

    $stmt = $pdo->prepare($query);
    $stmt->execute([":userId" => $userId]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = null;
    return $result;
}

function findUser(object $pdo, int $userId){
    $query = "SELECT username FROM users WHERE id = :userId";

    $stmt = $pdo->prepare($query);
    $stmt->execute([":userId" => $userId]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;
    return $result["username"];
}

function getUserIdFromSubmission(object $pdo, string $date, string $dayName, string $country){
    $query = "SELECT userId FROM submissions WHERE dayName = :dayName AND country = :country AND date = :date";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ":dayName" => $dayName,
        ":country" => $country,
        ":date" => $date
    ]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;
    return $result["userId"];
}

function insertSubmission(object $pdo, string $date, string $dayName, string $country, string $status){
    $query = "INSERT INTO days (date, dayName, country, submittedBy) VALUES (:date, :dayName, :country, :submittedBy)";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ":date" => $date,
        ":dayName" => $dayName,
        ":country" => $country,
        ":submittedBy" => findUser($pdo, getUserIdFromSubmission($pdo, $date, $dayName, $country))
    ]);

    $stmt = null;
    deleteSubmission($pdo, $date, $dayName, $country, $status);
}

function deleteSubmission(object $pdo, string $date, string $dayName, string $country, string $status){
    inboxMessage($pdo, $date, $dayName, $country, $status);
    $query = "DELETE FROM submissions WHERE date = :date AND dayName = :dayName AND country = :country";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ":date" => $date,
        ":dayName" => $dayName,
        ":country" => $country
    ]);

    $stmt = null;
}

function inboxMessage(object $pdo, string $date, string $dayName, string $country, string $status){
    $query = "INSERT INTO inbox (date, dayName, status, userId) VALUES (:date, :dayName, :status, :userId)";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ":date" => $date,
        ":dayName" => $dayName,
        ":status" => $status,
        ":userId" => getUserIdFromSubmission($pdo, $date, $dayName, $country)
    ]);

    $stmt = null;
}