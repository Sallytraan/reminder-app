<?php
require_once "../API/api.php";

// ska kunna radera en task
function deleteTask($taskID) {
    $tasks = loadJson("../API/list.json");
    $ongoingTasks = $tasks["ongoing"];
    $found = false;

    foreach ($ongoingTasks as $taskObj => $key) {
        if ($taskID == $key["id"]) {
            $found = true;
            array_splice($ongoingTasks, $taskObj, 1);
            $index = $taskObj;
        }
    }

    if ($found) {
        // unset funkar, men ändrar i JSON så att javascript inte kan skriva ut det i hemsidan (kan inte fetcha det heller...)
        unset($tasks["ongoing"][$index]);
        saveJson("../API/list.json", $tasks);

        //array_splice($tasks["ongoing"], $index);
        //var_dump($tasks["ongoing"][$index]);
    }

    header("Location: ../index.php");
    exit();
}

// kollar om ID:et finns i webbläsaren.
if (isset($_GET["id"])) {
    $deleteTaskID = $_GET["id"];

    deleteTask($deleteTaskID);
}

// om användarens ID inte finns med i session ska man inte kunna radera "tasks".
/* if(!isset($_SESSION["id"])) {
    header("Location: ../ADMIN/sign-in.php");
    exit();
} */
?>