<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    include_once("../config/connection.php");
    include("functions.php");

    $email = $_POST["emailUI"];
    $password = $_POST["passwordUI"];

    $reEmail = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";
    $rePassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";

    $err = 0;

    if (isset($_POST["emailUI"])) {
        if (!preg_match($reEmail, $email)) {
            $err++;
        }
    }
    if (isset($_POST["passwordUI"])) {
        if (!preg_match($rePassword, $password)) {
            $err++;
        }
    }
    $msg = "";
    if ($err == 0) {
        $encryptedPass = md5($password);
        $login = logUser($email, $encryptedPass);
        if (!is_null($login->id)) {
            $_SESSION["user"] = $login;
            $msg = ["msg" => "You have successfully logged in"];
            http_response_code(200);
            echo json_encode($msg);
        } else {
            $msg = ["msg" => "Your password/email doesn't match"];
            http_response_code(401);
            echo json_encode($msg);
        }
    } else {
        header("Location: ../err404.php");
    }
}
