<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_SESSION['user']->uloga) == "Admin") {
    header("Content-type: application/json");
    include_once("../config/connection.php");
    include_once("functions.php");
    $id = $_POST["idUser"];
    if (isset($id)) {
        $deletePost = delete($id, "korisnici", "id_korisnik");
        if ($deletePost) {
            $msg = ["msg" => "You have successfully deleted a user."];
            http_response_code(200);
            echo json_encode($msg);
        } else {
            $msg = ["msg" => "This user can't be deleted at this moment..."];
            http_response_code(500);
            echo json_encode($msg);
        }
    } else {
        $msg = ['msg' => 'Error with reciving data'];
        http_response_code(500);
        echo json_encode($msg);
    }
} else {
    header('Location: ../err404.php');
}
