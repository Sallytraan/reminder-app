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
<div id="signInWrapper">
 <div id="signInCircleOne"></div>
 <div id="signInCircleTwo"></div>
 <div id="signInCircleThree"></div>
    <div class="signUpSignInWhiteWrapper">
  <form method="POST" action="sign-in.php">
  <div class="signInForm">
    <h1 id="signInTitle">Welcome</h1>
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


