<?php
session_start();
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
        <link rel="icon" href="INCLUDES/reminder_logotyp.svg">
    </head>
    <body>
        <header>
        <?php
        $completedTask = json_decode(file_get_contents("API/finishedList.json"), true);
        
        // så tiden är samma som i Sverige.
        clearArray();
        function clearArray() {
            date_default_timezone_set('Europe/Stockholm');
            if (date("H") == 8 && date("i") == 00 && date("l") == "Monday") {
                // rensar array:en klockan 8 på måndagar.
                $completedTask = [];

                // sen spara det tillbaks.
                copy("API/finishedList.json", "API/finishedList_backup.json");
                $json = json_encode($completedTask, JSON_PRETTY_PRINT);
                file_put_contents("API/finishedList.json", $json);
            }
        }

        if (isset($_SESSION["id"])) {
            // variabler
            $data = json_decode(file_get_contents("API/users.json"), true);
            $userName = json_encode($_SESSION["username"], JSON_PRETTY_PRINT);
            $id = $_SESSION["id"];
                
        }

        // kollar om man är inloggad + kontrakt = visar headern för användaren.
        if (isset($_SESSION["id"])) {
            $id = $_SESSION["id"];
            echo "
            <p id='logotyp'> Reminder </p>"; 

            // det vi vill överföra till js och använda
            echo "
            <script> 
                const ID = $id 
                const USER = $userName
            </script>
            ";
        }
        ?>
        </header>
        <main id="wrapper">
