<?php
    require_once "./includes/config.inc.php";
    require_once "./includes/view/signup_view.inc.php";
    require_once "./includes/view/login_view.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp/Login</title>
    <link rel="stylesheet" href="css/form.css">
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
        <h1 style="text-align: center; margin-block: 5px">Sign Up:</h1>
        <form action="./includes/signup.inc.php" method="post">
            <label for="username">Enter Username:</label>
                <input type="text" id="username" name="username" max="30">
            <label for="pwd">Enter Password:</label>
                <input type="password" id="pwd" name="pwd" max="255">
            <button type="submit">Sign Up</button>
        </form>

        <h1 style="text-align: center; margin-block: 5px">Login:</h1>
        <form action="./includes/login.inc.php" method="post">
            <label for="username">Enter Username:</label>
                <input type="text" id="username" name="username" max="30">
            <label for="pwd">Enter Password:</label>
                <input type="password" id="pwd" name="pwd" max="255">
            <button type="submit">Login</button>
        </form>
    </main>
    <footer class="footer">
        <?php handleSignUpErrors();
         handleLoginErrors() ?>
    </footer>
</body>
</html>