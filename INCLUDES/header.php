<?php
//error_reporting(-1);
session_start();
// require_once __DIR__ . "/API/api.php";
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
    </head>
    <body>
        <header>
        <?php
            // kollar om id:et finns i sessionen. Om den finns ska man kunna se loggan i headern.

            /*
            <?php
            // kollar om id:et finns i sessionen. Om den finns ska man kunna se loggan i headern.
            if (isset($_SESSION["id"])) {
                $id = $_SESSION["id"];

                $dataUsers = loadJson("API/users.json");
                foreach ($dataUsers as $key => $value) {
                    if ($id === $value["id"]) {
                        echo "
                        <p> LOGGAN HÄR! </p>
                        ";
                    }
                }
            }
            ?>
            */
            if (isset($_SESSION["id"]) && $value["contract"]) {
                echo "
                <p> LOGGAN HÄR! </p>";
            }
            ?>
        </header>
        <main id="wrapper">

        <?php
        if (isset($_SESSION["id"], $_SESSION["username"])) {
            $id = $_SESSION["id"];
            $userName = $_SESSION["username"];
                echo "<script> const ID = $id </script>";
                echo "<script> const USER_NAME = $userName </script>";            
        }
        ?>