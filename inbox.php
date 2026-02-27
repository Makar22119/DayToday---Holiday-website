<?php
    require_once "./includes/config.inc.php";
    require_once "./includes/model/inbox_model.inc.php";
    require_once "./includes/view/inbox_view.inc.php";
    require_once "./classes/Dbh.class.php";

    $pdo = new Dbh();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
    <link rel="stylesheet" href="css/inbox.css">
</head>
<body>
    <?php isUserAllowed() ?>
    <nav class="nav">
        <a href="index.php" class="logo">
            <img src="images/Logo.png" alt="logo.png">
            DayToday
        </a>
        <div class="empty"></div>
    </nav>
    <main class="main">
        <h1 style="text-align: center">Inbox:</h1>
        <ul>
            <?php generateInbox(array_reverse(getUsersInbox($pdo->connect(), $_SESSION["userId"]))) ?>
        </ul>
    </main>
    <footer class="footer">
        <h2>&copy;Pryanik123&trade;</h2>
    </footer>
</body>
</html>