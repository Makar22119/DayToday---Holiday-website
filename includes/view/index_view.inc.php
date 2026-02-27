<?php
declare(strict_types = 1);

function meetUser(){
    if (isset($_SESSION['userId'])) 
        echo "<h2 style='font-size: min(2em, 5vw); text-align: center'> Welcome, " . $_SESSION['userUsername'] .  "! </h2>";
}

function generateMenu(object $pdo){
    if (isset($_SESSION['userId'])){
        echo isset(json_decode(checkUserRoles($pdo, ($_SESSION['userId']))[0]['roles'], true)['admin']) ? 
            '<a href="submissions.php" class="even">Submissions</a>
            <button class="js-logout-but odd">Logout</button>' 
            : '<a href="submitForm.php" class="even">Submit</a>
            <a href="inbox.php" class="odd">Inbox</a>
            <button class="js-logout-but even">Logout</button>';
    } else echo '<a href="form.php" class="even">Login</a>';
}

function showDays(bool|array $result){
    if ($result){
        usort($result, function ($a, $b){
            return $a['submittedBy'] !== $b['submittedBy'];
        });
        foreach ($result as $day){
            print_r("<li> <p>" . $day['dayName'] . " - " . $day['country'] . "</p>");
            print_r($day['submittedBy'] ? '<span style="font-size: 0.5em">Submitted by ' . $day['submittedBy'] . ' </span> </li>' : "</li>");
        }
    } 
}

function dateReformat(DateTime $today){
    return $today->format("F d");
}