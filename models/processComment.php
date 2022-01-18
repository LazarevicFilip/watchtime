<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user"])) {
    header("Content-type: application/json");
    include_once("../config/connection.php");
    include("functions.php");

    $comment = addslashes($_POST["commentUI"]);
    $postId = $_POST['postIdUI'];
    $userId = $_SESSION["user"]->id;

    if (isset($comment) && isset($postId) && isset($userId)) {
        if (strlen($comment) > 2) {
            $insertComment = insertComm($comment, $postId, $userId);
            if ($insertComment) {
                $msg = ["msg" => "You have successfully post a comment"];
                http_response_code(201);
                echo json_encode($msg);
            } else {
                $msg = ['msg' => "Commenting this post is currently not available"];
                http_response_code(500);
                echo json_encode($msg);
            }
        } else {
            $msg = ['msg' => "Comment must have at least 3 characters"];
            http_response_code(400);
            echo json_encode($msg);
        }
    } else {
        $msg = ['msg' => "Error!"];
        http_response_code(400);
        echo json_encode($msg);
    }
} else {
    header("Location: ../err404.php");
}
