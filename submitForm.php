<?php
    require_once "./includes/config.inc.php";
    require_once "./includes/view/submit_view.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit</title>
    <link rel="stylesheet" href="css/submitForm.css">
</head>
<body>
    <?php isUserAllowed() ?>
    <header class="header">
        <a href="index.php" class="logo">
            <img src="images/Logo.png" alt="logo.png">
            DayToday
        </a>
    </header>
    <main class="main">
        <h1>Post a submission:</h1>
        <form action="./includes/submit.inc.php" method="post">
            <label for="date">Select Date:</label>
                <input type="date" name="date" id="date">
            <label for="dayName">Day Name:</label>
                <input type="text" name="dayName" id="dayName">
            <label for="country">Country:</label>
                <input type="text" name="country" id="country">
            <div class="empty"></div>
            <button type="submit">Submit</button>
        </form>
    </main>
    <footer class="footer">
        <?php handleSubmitErrors(); ?>
    </footer>
</body>
</html>