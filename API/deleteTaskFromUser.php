<?php
//require_once "api.php";
require_once "../functions.php";

// ska kunna radera en task
function deleteTask($taskID) {
    $tasks = loadJson("../API/ongoingList.json");
    $found = false;

    foreach ($tasks as $taskObj => $key) {
        if ($taskID == $key["id"]) {
            $found = true;
            $index = $taskObj;
        }
    };

    if ($found) {
        array_splice($tasks, $index, 1);
        saveJson("../API/ongoingList.json", $tasks);
    };

    header("Location: ../index.php");
    exit();
}

// kollar om ID:et finns i webbläsaren och radera den task vars id det är.
if (isset($_GET["id"])) {
    $deleteTaskID = $_GET["id"];

    deleteTask($deleteTaskID);
}
?>