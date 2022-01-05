<?php
//error_reporting(-1);
session_start();
// require_once __DIR__ . "/API/api.php";
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
    </head>
    <body>
        <header>
        <?php
        // variabler
        $data = json_decode(file_get_contents("API/users.json"), true);
        $taskData = json_decode(file_get_contents("API/list.json"), true);
        $ongoingTasks = $taskData["ongoing"];
        $id = $_SESSION["id"];
        $userName = json_encode($_SESSION["username"], JSON_PRETTY_PRINT);

        //echo $user;

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
            
            // går igenom list.json för att få fram användarens tasks.
            foreach ($ongoingTasks as $obj => $value) {
                $taskArray = [];
                if ($id == $value["user"]) {
                    $task = $value["task"];
                    $date = $value["date"];                    
                }

                // så vi får JSON-datat                    
                $JSONdataTasks = json_encode($task, JSON_PRETTY_PRINT);
                $JSONdataDates = json_encode($date, JSON_PRETTY_PRINT);
            }
            echo "<script> const TASK = $JSONdataTasks </script>";
            echo "<script> const DATE = $JSONdataDates </script>";

            echo "
            <script> 
                const ID = $id 
                const USER = $userName
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



