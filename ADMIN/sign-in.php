<?php
session_start();
require_once "../API/api.php";

if (isset($_POST["email"], $_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $userData = loadJson("../API/users.json");
}

?>



<?php
require_once "../INCLUDES/header.php";
?>

<form method="POST" action="/sign-in.php">
    <h1>Let's get you logged in!</h1>
    <?php 
        // Om inloggning misslyckas.  
        if (isset($_GET["error"])) {
            echo "<p class='error'> Your email or password is incorrect. Please try again.</p>";
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

<?php
if (isset($_GET["error"])){
    $error = $_GET["error"];

    if ($error == 1) { //Fälten är tomma
        echo '<p class="error">Please fill out all fields.</p>';
    } elseif ($error == 2) { //fel lösenord
        echo '<p class="error">Incorrect password.</p>';
    } elseif ($error == 3) { //fel email
        echo '<p class="error">The email does not exist.</p>';
    } elseif ($error == 4) { //fel kombination av lösenord och
        echo '<p class="error">Incorrect username or password.</p>';
    }
}
?>

<?php
require_once "../INCLUDES/footer.php";
?>
