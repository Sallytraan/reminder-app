<?php
require_once "../functions.php";

// ska kunna radera en task
function moveTask($taskID) {
    $tasks = loadJson("../API/ongoingList.json");
    $finishedList = loadJson("../API/finishedList.json");
    $found = false;

    foreach ($tasks as $taskObj => $key) {
        if ($taskID == $key["id"]) {
            $found = true;
            $index = $taskObj;

            // kopia av den tasken som man vill flytta på.
            $copyTask = [
                "id" => $key["id"],
                "user" => $key["user"],
                "priority" => $key["priority"], 
                "task" => $key["task"],
                "date" => $key["date"]
            ];
        }
    };

    if ($found) {
        array_splice($tasks, $index, 1);
        saveJson("../API/ongoingList.json", $tasks);

        array_push($finishedList, $copyTask);
        saveJson("../API/finishedList.json", $finishedList);
    }; 

    header("Location: ../index.php");
    exit();
}

// kollar om ID:et finns i webbläsaren och flyttar den till finishedList.json.
if (isset($_GET["id"])) {
    $getID = $_GET["id"];

    moveTask($getID);
}
?>