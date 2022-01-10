<?php
session_start();
//require_once "../API/api.php";
require_once "../functions.php";

$userData = loadJson("../API/users.json"); // ska hämta användarens info.

// behöver inte kolla om 
if (isset($_POST["email"], $_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];


    if (empty($email) && empty($password)) {
        header("Location: /ADMIN/sign-in.php?error=1");
        exit();
    }

    if (empty($email)) {
        header("Location: /ADMIN/sign-in.php?error=2");
        exit();
    }

    if (empty($email) && empty($password)) {
        header("Location: /ADMIN/sign-in.php?error=3");
        exit();
    }

    if (!empty($email) && !empty($password)) {
        // kollar om lösenordet är större än 3 och om email innehåller @.
        if (strlen($password) > 3 && strpos($email, "@") !== false) {
            //loopar igenom användarna för att se om det finns en användare med den email + lösenord.
            foreach ($userData as $user) {
                if ($user["email"] == $email && $user["password"] == $password) {
                    if (isset($user["id"])) {
                        $_SESSION["id"] = $user["id"]; // vilket id som är inloggad.
                        $_SESSION["loggedIn"] = true; //inloggad anv.

                        // vart användaren ska skickas om lyckad inloggning.
                        header("Location: ../index.php");
                        exit();
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="414, initial-scale=1.0">
        <title>Reminder</title>
        <link rel="stylesheet" href="../CSS/commonElements.css">
        <link rel="stylesheet" href="../CSS/focus.css">
        <link rel="stylesheet" href="../CSS/list.css">
        <link rel="stylesheet" href="../CSS/welcome.css">
        <link rel="stylesheet" href="../CSS/profile.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Yeseva+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet"> 
        <link rel="icon" href="../INCLUDES/reminder_logotyp.svg">
    </head>
    <body>
        <div id="signInWrapper">
        <div id="signInCircleOne"></div>
        <div id="signInCircleTwo"></div>
        <div id="signInCircleThree"></div>
            <div class="signUpSignInWhiteWrapper">
        <form method="POST" action="sign-in.php">
        <div class="signInForm">
            <img class="transLogo" src="../INCLUDES/reminder_logotyp_transparent.svg" alt="logo">
            <h1 id="signInTitle">Welcome</h1>
            <?php 
                // Om inloggning misslyckas.  
                if (isset($_GET["error"])) {
                    $error = $_GET["error"];

                    if ($error == 1) {
                        echo '<p class="error"> All the fields need to be filled in! </p>';
                    } elseif ($error == 2) {
                        echo "<p class='error'> You have to fill in the email field. </p>";
                    } elseif ($error == 3) {
                        echo "<p class='error'> That email doesn't exists. </p>";
                    } elseif ($error == 4) {
                        echo "<p class='error'> Either the password or email is incorrect. Try again. </p>";
                    }
                } 
            ?>
            <input type="text" name="email" placeholder="Email" class="iconEmail inputIcon">
            <input type="password" name="password" placeholder="Password" class="iconPassword inputIcon">
            <button class="signUpSignInButton">Sign in</button>
            <div id="signUpSignInOption">
            <p> Don't have an account? 
            <br> <a href="sign-up.php"> Create an account </a></p>
            </div>
            </div>
        </div>
        </form>
        </div>
    <body>
</html>

