<?php 

require_once "../functions.php";

// Ladda in vår JSON data från vår fil
$users = loadJson("users.json");

// Vilken HTTP metod vi tog emot
$method = $_SERVER["REQUEST_METHOD"];

// Hämta ut det som skickades till vår server
$data = file_get_contents("php://input");
$requestData = json_decode($data, true);

if ($method != "PATCH") {
    send(
        ["message" => "Method not allowed. Only 'PATCH' works."],
        405
    );
}

if ($method === "PATCH") {

    // Kontrollera att vi har den datan vi behöver
    if (!isset($requestData["id"])) {
        send(
            [
                "code" => 3,
                "message" => "Missing `id` of request body"
            ],
            400
        );
    }

    $id = $requestData["id"];
    $found = false;
    $foundUser = null;

    foreach ($users as $index => $user) {

        //Om ID som skickas med finns i users.json
        if ($user["id"] == $id) {
            $found = true;

            if (isset($requestData["username"])) {

                //om firstname är = 0 tecken
                if (strlen($requestData["username"]) == 0) {
                    send([
                        "code" => 401,
                        "message" => "Bad request, invalid format",
                        "errors" => [
                                [
                                    "field" => "username",
                                    "message" => "`username` has to be more then 0 characters"
                                ]
                        ]
                    ]); 
                }

                $user["username"] = $requestData["username"];
            }

            if (isset($requestData["email"])) {

                //om email är = 0 tecken
                if (strlen($requestData["email"]) == 0) {
                    send([
                        "code" => 401,
                        "message" => "Bad request, invalid format",
                        "errors" => [
                                [
                                    "field" => "email",
                                    "message" => "`email` has to be more then 0 characters"
                                ]
                        ]
                    ]); 
                }

                $user["email"] = $requestData["email"];
            }

            // Uppdatera vår array
            $users[$index] = $user;
            $foundUser = $user;
            break;
        }
    }

    if ($found === false) {
        send(
            [
                "code" => 5,
                "message" => "The users by `id` does not exist"
            ],
            404
        );
    }

    saveJson("users.json", $users);
    send($foundUser);

}

?>