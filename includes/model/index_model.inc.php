<?php
declare (strict_types = 1);

function getDays(object $pdo){
    $query = "SELECT dayName, country, submittedBy FROM days WHERE DATE_FORMAT(date, '%M %d') = :date";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ":date" => currentDay()->format('F d')
    ]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function checkUserRoles(object $pdo, int $userId){
    $query = "SELECT roles FROM users WHERE id = :userId";

    $stmt = $pdo->prepare($query);
    $stmt->execute([":userId" => $userId]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = null;
    return $result;
}

function currentDay(){
    return DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
}