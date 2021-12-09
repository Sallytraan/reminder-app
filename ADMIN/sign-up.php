<?php
require_once "../INCLUDES/header.php";
?>


<form method="POST" action="sign-up.php">
<div id="signInForm">
    <h1>Create an account</h1>
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <input type="password" name="password" placeholder="Confirm password">
    <button id="sign-up-button">Sign in</button>
    </div>
</form>

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
