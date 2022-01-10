<?php

require_once "../functions.php";

$users = loadJson("users.json");
// Vilken HTTP metod vi tog emot
$method = $_SERVER["REQUEST_METHOD"];

// Hämta ut det som skickades till vår server
$data = file_get_contents("php://input");
$requestData = json_decode($data, true);

$contentType = $_SERVER["CONTENT_TYPE"];

// Content-Type: application/json; charset=utf-8; <- ibland skickas det i detta format
if ($contentType !== "application/json") {
    send(
        ["message" => "The API only accepts JSON"],
        400
    );
}

// Om det inte är DELETE
if ($method != "DELETE") {
    send(
        ["message" => "Method not allowed. Only 'DELETE' works."],
        405
    );
}

// Tar emot { id } och sedan raderar en användare baserat på id
if ($method === "DELETE") {

    // Kontrollera att vi har den datan vi behöver
    if (!isset($requestData["id"])) {
        send(
            [
                "code" => 1,
                "message" => "Missing `id` of request body"
            ],
            400
        );
    }

    // Kontrollera att id är en siffra
    $id = $requestData["id"];
    $found = false;

   // Om id existerar
   foreach ($users as $index => $user) {
    if ($user["id"] == $id) {
        $found = true;
        array_splice($users, $index, 1);
        break;
        }
    }

    // Om id inte existerar
    if ($found === false) {
        send(
            [
                "code" => 2,
                "message" => "The users by `id` does not exist"
            ],
            404
        );
    }

    // Uppdaterar filen
    $userjson = "users.json";
    saveJson($userjson, $users);
    send(
        ["You have deleted the following user" => $user],
        200
    );
}
?>
