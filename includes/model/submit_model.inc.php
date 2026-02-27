<?php
declare(strict_types = 1);

function findSubmission(object $pdo, string $dayName, string $country){
    $query = 'SELECT * FROM submissions WHERE dayName = :dayName AND country = :country';

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ":dayName" => $dayName,
        ":country" => $country
    ]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;

    return $result;
}

function findDay(object $pdo, string $dayName, string $country){
    $query = 'SELECT * FROM days WHERE dayName = :dayName AND country = :country';

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ":dayName" => $dayName,
        ":country" => $country
    ]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;

    return $result;
}

function postSubmission(object $pdo, string $date, string $dayName, string $country, int $userId){
    $query = 'INSERT INTO submissions (date, dayName, country, userId) VALUES (:date, :dayName, :country, :userId)';

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':date' => $date,
        ':dayName' => $dayName,
        ':country' => $country,
        ':userId' => $userId,
    ]);

    $stmt = null;
}