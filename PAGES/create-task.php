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
        } else {
            if (strlen($task) > 2) {
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
        <!-- Behövs en ny css-fil för create-task.php?? !-->
    </head>
    <body>
        <header>
            <p> LOGGAN HÄR! </p>
<?php
// require_once "../INCLUDES/header.php"; funkar ej eftersom de har annorlunda sökväg än index.php
?>
        </header>
            <main id="wrapper">

                <form method="POST" action="create-task.php">
                    <?php 
                        // Skriva felmeddelande angånde task-skrivandet här!!  
                    ?>
                    <input type="text" name="task" id="taskInput" placeholder="What do you need to be reminded of?">
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
                    <?php 
                        // kanske ta bort button nedan. se vad som är bäst.  
                    ?>
                    <button id="undo-button"> 
                    <a href="../index.php"><img src="../ICONS_BLACK/remove-icon.svg"></a>
                    </button>
                    <button id="add-button">
                        <img src="../ICONS_BLACK/check-icon.svg">
                    </button>

                </form>
            </main>
    </body>
</html> 
        