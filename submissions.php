<?php
    require_once "./includes/config.inc.php";
    require_once "./includes/controllers/submissionCheck_controller.inc.php";
    require_once "./includes/model/submissionCheck_model.inc.php";
    require_once "./includes/view/submissionCheck_view.inc.php";
    require_once "./classes/Dbh.class.php";

    $pdo = new Dbh();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submissions</title>
    <link rel="stylesheet" href="css/submissions.css">
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
        <h1 style="text-align: center">People Submissions:</h1>
        <ul>
            <?php showSubmissions(getSubmissions($pdo->connect(), $_SESSION['userId']), $pdo->connect()) ?>
        </ul>
    </main>
    <footer class="footer">
        <h2>&copy;Pryanik123&trade;</h2>
    </footer>
    <script src="js/submissions.js"></script>
</body>
</html>