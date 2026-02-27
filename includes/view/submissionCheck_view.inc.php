<?php
declare(strict_types = 1);

function showSubmissions(bool|array $result, object $pdo){
    if ($result){
        foreach ($result as $submission){
            print_r('<div class="submission-container js-submission-container" id="' . $submission['id'] . '">
                <p class="date" id="' . $submission['date'] . '" style="grid-area: date; font-size: min(2rem, 7vw)">' . date("F d", strtotime($submission['date'])) . '</p>
                <div class="day" style="grid-area: day; display: flex; flex-direction: column; text-align: center">
                    <span style="font-size: min(1.5rem, 4vw)"><span class="dayName">' . $submission['dayName'] . '</span> - <span class="country">' . $submission['country'] . '</span></span>
                    <span style="font-size: min(1.2rem, 3vw)">Submitted by <span class="user" id="' . $submission['userId'] . '">' . findUser($pdo, $submission['userId']) . '</span></span>
                </div>
                <button class="accept-but">Accept</button>
                <button class="deny-but">Deny</button>
            </div>');
        }
    } else {
        print_r("<p>No Submissions Found</p>");
    }
}

function isUserAllowed(){
    if (!isset($_SESSION['userId'])) header('Location: index.php');
}