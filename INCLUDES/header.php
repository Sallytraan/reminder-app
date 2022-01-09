<?php
//error_reporting(-1);
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

if (isset($_SESSION["id"])) {
        // variabler
        $data = json_decode(file_get_contents("API/users.json"), true);
        $taskData = json_decode(file_get_contents("API/list.json"), true);
        $userName = json_encode($_SESSION["username"], JSON_PRETTY_PRINT);
        $id = $_SESSION["id"];
        

        $changeContract = 'changeIt';
        
        // testar om jag kan överföra JSON till js.
        $JSONTaskData = json_encode($taskData, JSON_PRETTY_PRINT);

        $JSONUserData = json_encode($data, JSON_PRETTY_PRINT);
}


        
        // var_dump($_SESSION); // för att kolla vad som finns i den.
        // kollar om man är inloggad + kontrakt = visar headern för användaren.
        if (isset($_SESSION["id"])) {
            
            $id = $_SESSION["id"];
            

            foreach ($data as $key => $value) {
                if ($id == $value["id"]) {
                    // göra if-sats för bara inloggning har tillgång till anv.
                    if ($value["contract"]) {
                        echo "
                        <p id='logotyp'> Reminder </p>";                
                    }        
                }
            }

            // det vi vill överföra till js och använda
            echo "
            <script> 
                const ID = $id 
                const USER = $userName
                const TASK_DATA = $JSONTaskData
                const USER_DATA = $JSONUserData
                const theContract = $changeContract()
            </script>
            ";
                //echo "<script>  </script>";
                //$sessionID = $_SESSION["id"];
                // $contractChange = $changeTheContract;
                
                // echo "<script> const changeContract = $contractChange </script>";
                //echo "<script> const ID = $id </script>";
                //echo "<script> const USER_NAME = $userName </script>";
        }



        ?>
        </header>
        <main id="wrapper">
