<?php
session_start();
require_once "../API/api.php";

$data = loadJson("../API/list.json");
$userTasks = $data["ongoing"];

// om inte id finns i session ska man åka tillbaka till index-sidan.
if (!isset($_SESSION["id"])) {
    header("Location: ../index.php");
    exit();
}

if (isset($_SESSION["id"])) {
    $sessionID = $_SESSION["id"];

    if (isset($_POST["task"])) {
        // variabler
        $task = $_POST["task"];
        $highestID = 0;
        $today = date("F j, Y"); // variabel för dagens datum.

        if (empty($task)) {
            header("Location: /PAGES/create-task.php?error=1");
            exit();
        }
        
        if (strlen($task) < 3) {
            header("Location: /PAGES/create-task.php?error=2");
            exit();
        }

        if (strlen($task) > 3) {
            foreach ($userTasks as $tasks => $singleTask) {
                if ($singleTask["id"] > $highestID) {
                    $highestID = $singleTask["id"];
                }
            }

            // skapar ny task till arrayen.
            $newTask = [
                "id" => $highestID + 1,
                "user" => $sessionID,
                "priority" => 2, // DENNA MÅSTE FIXAS, har inte gjort en array med färger osv. än.
                "task" => $task,
                "date" => $today
            ];

            // sparar ner det till list.json
            array_push($data["ongoing"], $newTask);
            saveJson("../API/list.json", $data);

            // gå tillbaka till list-sidan
            header("Location: ../index.php");
            exit();
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
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Yeseva+One&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <p id='logotyp'> Reminder </p>
        </header>

        <main id="taskWrapper">
            <form method="POST" action="create-task.php">
                <input type="text" id="taskInput" name="task" placeholder="What do you need to be reminded of?">               
                <?php
                // Skriva felmeddelande angånde task-skrivandet här!!
                if (isset($_GET["error"])) {
                    $error = $_GET["error"];

                    if ($error == 1) {
                        echo "<p class='errorTask'> You can't have an empty reminder. </p>";
                    }

                    if ($error == 2) {
                        echo "<p class='errorTask'> You have to include at least three letters. </p>";
                    }
                }
                ?>
                <div>
                    <div id="taskText">
                        <p>What's the level of importance?</p>
                    </div>
                    <div id="importantCircles">
                        <div id="circle1"></div>
                        <div id="circle2"></div>
                        <div id="circle3"></div>
                    </div>
                </div>                    
                <div id="addUndoButtons">
                    <a href="../index.php"><img id="undo-button" src="../ICONS_BLACK/remove-icon.svg"></a>
                    <img id="add-button" src="../ICONS_BLACK/check-icon.svg">
                </div>
            </form>
        </main>
    </body>
</html> 
        