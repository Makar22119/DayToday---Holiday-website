<?php
declare(strict_types = 1);

function generateInbox(bool|array $result){
    if ($result){
        foreach ($result as $submission){
            print_r('<div class="response ' . $submission["status"] .'">
                        <p>' . dateReformat(submissionDay($submission["date"])) . ' - ' . $submission["dayName"] . ' has been ' . $submission["status"] . '</p>
                    </div>');
        }
    } else {
        print_r("<p>Your inbox is currently empty</p>");
    }
}

function isUserAllowed(){
    if (!isset($_SESSION["userId"])) header('Location: index.php');
}

function dateReformat(DateTime $today){
    return $today->format("M d");
}
function submissionDay(string $date){
    return DateTime::createFromFormat('Y-m-d', $date);
}