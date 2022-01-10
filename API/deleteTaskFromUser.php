<?php
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

        $file = "ongoingList.json";
        $newfile = "ongoingList_backup.json";
    };

    header("Location: ../index.php");
    exit();
}

// kollar om ID:et finns i webbläsaren och radera den task vars id det är.
if (isset($_GET["id"])) {
    $deleteTaskID = $_GET["id"];

    deleteTask($deleteTaskID);
}

/*
        copy($file, $newfile);
        saveJson("../API/ongoingList.json", $tasks);

        if (!copy($file, $newfile)) {
            send(
                ["message" => "Failed to copy $file"],
                404
            );
        } else {
            send(
                ["message" => "Successfully copied $file!"]
            );
        }
*/
?>