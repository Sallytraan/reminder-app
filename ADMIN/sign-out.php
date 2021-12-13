<?php
// Utloggning. Töm sessionen på data innan du slussar vidare dom till start-
// eller inloggningssidan.
session_start();
//unset($_SESSION["isLoggedIn"]);
session_destroy();
header("Location:/index.php");
exit();
?>