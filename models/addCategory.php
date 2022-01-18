<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_SESSION["user"]->uloga == "Admin") {
    header("Content-type: application/json");
    include_once '../config/connection.php';
    include_once 'functions.php';

    $categories = addslashes($_POST["nameCatUI"]);
    $categoriesRe = "/^([A-Z]|[0-9])[\sA-Za-z\d.?,!_-]{2,48}$/";


    if (isset($categories)) {
        if (preg_match($categoriesRe, $categories)) {
            try {
                $insertMsg = insertCategory($categories);
                if ($insertMsg) {
                    $msg = ['msg' => 'You have successfully add category'];
                    echo json_encode($msg);
                    http_response_code(201);
                }
            } catch (PDOException $exception) {
                http_response_code(500);
                $msg = ['msg' => "There is some problems with a server..."];
                echo json_encode($exception);
            }
        } else {
            http_response_code(500);
            $msg = ['msg' => "There is a problem with category that you insert"];
            echo json_encode($msg);
        }
    }
} else {
    header("Location: ../err404.php");
}
