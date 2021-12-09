<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="414, initial-scale=1.0">
        <title>Reminder</title>
        <link rel="stylesheet" href="CSS/commonElements.css">
        <link rel="stylesheet" href="CSS/focus.css">
        <link rel="stylesheet" href="CSS/list.css">
        <link rel="stylesheet" href="CSS/welcome.css">
        <link rel="stylesheet" href="CSS/profile.css">
    </head>
    <body>
        <header>
            <?php
            // kollar om id:et finns i sessionen. Om den finns ska man kunna se loggan i headern.
            if (isset($_SESSION["id"])) {
                echo "
                <p> LOGGAN HÄR! </p>";
            }
            ?>
        </header>
        <main id="wrapper">

<?php

?>