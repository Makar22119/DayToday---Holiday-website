<?php
    require_once "./includes/config.inc.php";
    require_once "./includes/model/index_model.inc.php";
    require_once "./includes/view/index_view.inc.php";
    require_once "./classes/Dbh.class.php";

    $pdo = new Dbh();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DayToday</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="blackScreen off"></div>
    <nav class="nav">
        <a href="index.php" class="logo">
            <img src="images/Logo.png" alt="logo.png">
            DayToday
        </a>
        <div class="empty"></div>
        <div class="fixed"></div>
        <button class="nav-menu-but js-nav-menu-but">Menu</button>
        <div class="menu closed">
            <?php generateMenu($pdo->connect()) ?>
        </div>
    </nav>
    <header class="header">
        <div class="introduction">
            <h1 style="font-size: min(7em, 15vw)">DayToday</h1>
            <p style="font-weight: 400; font-size: 1.2em">What's new today?</p>
        </div>
    </header>
    <main class="main">
        <?php meetUser() ?>
        <h2 style="font-size: min(2em, 5vw); text-align: center">Today is <span class="highlight"> <?php echo dateReformat(currentDay()) ?> </span></h2>
        <ul>
            <?php showDays(getDays($pdo->connect())) ?>
        </ul>
    </main>
    <footer class="footer">
        <h2>&copy;Pryanik123&trade;</h2>
    </footer>
    <script src="js/index.js"></script>
</body>
</html>