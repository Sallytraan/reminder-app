<?php
require_once "../functions.php";

// hämta metoden i servern.
$requestMethod = $_SERVER["REQUEST_METHOD"];
// hämtar typ av innehåll från servern.
$contentType = $_SERVER["CONTENT_TYPE"];

if ($contentType !== "application/json") {
    send(
        ["message" => "Bad request. You're missing 'Content-Type'."],
        400
    );
}

if ($requestMethod !== "POST") {
    send(
        ["message" => "Method not allowed. You can only use 'POST'."],
        405
    );
}

// hämtar det som skickas till vår server (allt sparas typ här).
$data = file_get_contents("php://input");
//JSON till associative array. Det man skriver i insomnia.
$requestData = json_decode($data, true);

if ($requestMethod === "POST") {
    // skapa variabler
    $id = $requestData["id"];
    $username = $requestData["username"];
    $email = $requestData["email"];
    $password = $requestData["password"];
    $image = $requestData["image"];

    // kollar om dessa nycklar är med.
    if (!isset($username, $email, $password, $image)) {
        send(
            ["message" => "Bad request. There is one or more keys missing."],
            400
        );
    }

    // kollar om 'id' nyckeln är skriven.
    if (isset($id)) {
        send(
            ["message" => "The user 'id' is not allowed."],
            400
        );
    }

    if (strlen($username) < 3 || strlen($email) < 3) {
        send(
            ["message" => "Either 'username' or 'email' has less than 3 letters."],
            400
        );
    }

    // dessa är associative array av datan från filerna.
    $userData = loadJson("users.json"); 
    $highestID = 0;

    foreach ($userData as $index => $user) {
        if ($user["id"] > $highestID) {
            $highestID = $user["id"];
        }
    }
    
    // den nya användaren.
    $newUser = [
        "id" => $highestID + 1,
        "username" => $username,
        "email" => $email,
        "password" => $password,
        "image" => $image
    ];

    // lägga till användaren till users.json
    array_push($userData, $newUser);

    // spara vårt innehåll
    saveJson("users.json", $userData);
    send($newUser, 201);
} 
?>