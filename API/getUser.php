<?php

require_once "../functions.php";

$users = loadJson("users.json");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod != "GET") {
    send(
        ["message" => "Method not allowed. Only 'GET' works."],
        405
    );
}

if ($requestMethod == "GET") {
    // skapa varibler
    $username = $_GET["username"];
    $email = $_GET["email"];
    $id = $_GET["id"];
    $image = $_GET["image"];


     //Get one user
     if (isset($_GET["id"])) {
        foreach ($users as $key => $user) {
            if ($user["id"] == $_GET["id"]) {
                send($users[$key]);
            }
        }
    }
}
?>