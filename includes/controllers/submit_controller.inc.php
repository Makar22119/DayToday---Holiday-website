<?php
declare(strict_types = 1);

function isDataSubmitted(string $date, string $dayName, string $country){
    return ($date && $dayName && $country);
}

function isSubmissionAvailable(object $pdo, string $dayName, string $country){
    return !findSubmission($pdo, $dayName, $country);
}

function isDayAvailable(object $pdo, string $dayName, string $country){
    return !findDay($pdo, $dayName, $country);
}