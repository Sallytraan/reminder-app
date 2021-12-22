<?php
session_start();
require_once "../API/api.php";

$userData = loadJson("../API/users.json"); // ska hämta användarens info.

// behöver inte kolla om 
if (isset($_POST["email"], $_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];


    if (empty($email) && empty($password)) {
        header("Location: /ADMIN/sign-in.php?error=1");
        exit();
    }

    if (!empty($email) && !empty($password)) {
        // kollar om lösenordet är större än 3 och om email innehåller @.
        if (strlen($password) > 3 && strpos($email, "@") !== false) {
            //loopar igenom användarna för att se om det finns en användare med den email + lösenord.
            foreach ($userData as $user) {
                if ($user["email"] == $email && $user["password"] == $password) {
                    $foundUser = $user;
                }
            }

            if ($foundUser !== null) {
                $_SESSION["username"] = $foundUser["username"];
                $_SESSION["email"] = $foundUser["email"];
                $_SESSION["id"] = $foundUser["id"];
                

                // vart användaren ska skickas om lyckad inloggning.
                header("Location: ../index.php");
                exit();
            }
        }
    }
}
?>

<?php
require_once "../INCLUDES/header.php";
?>

<form method="POST" action="sign-in.php">
    <h1>Let's get you logged in!</h1>
    <?php 
        // Om inloggning misslyckas.  
        if (isset($_GET["error"])) {
            $error = $_GET["error"];

            if ($error == 1) {
                echo "<p class='error'> Your email or password is incorrect. Please try again.</p>";
            } elseif ($error == 2) {
                echo '<p class="error"> You forgot something... </p>';
            } elseif ($error == 3) {
                echo "<p class='error'> That email doesn't exists. </p>";
            } elseif ($error == 4) {
                echo "<p class='error'> hehehe. </p>";
            }
        } 
    ?>
    <input type="text" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button id="sign-up-button">Sign in</button>
</form>
<div>
    <p> Don't have an account? </p>
    <a href="sign-up.php"> Create an account </a>
</div>


