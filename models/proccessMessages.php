<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    header("Content-type: application/json");
    include_once '../config/connection.php';
    include_once 'functions.php';

    $message = addslashes($_POST["messageUI"]);
    $subject = addslashes($_POST["subjectUI"]);
    $email = $_POST["emailMsgUI"];
    $reEmail = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";
    $subjectRe = "/^([A-Z]|[0-9])[\sA-Za-z\d.?,!_-]{2,19}$/";
    $err = 0;

    if (isset($email)) {
        if (!preg_match($reEmail, $email)) {
            $err++;
        }
    }
    if (isset($message)) {
        if (strlen($message) < 20) {
            $err++;
        }
    }
    if (isset($subject)) {
        if (!preg_match($subjectRe, $subject)) {
            $err++;
        }
    }
    if ($err == 0) {
        try {
            $insertMsg = insertMsg($subject, $message, $email);
            if ($insertMsg) {
                $msg = ['msg' => 'You have successfully send a message'];
                echo json_encode($msg);
                http_response_code(201);
            }
        } catch (PDOException $exception) {
            http_response_code(500);
            $msg = ['msg' => "There is some problems with a server..."];
            echo json_encode($msg);
        }
    } else {
        http_response_code(500);
        $msg = ['msg' => "There is a problem with message that you insert"];
        echo json_encode($msg);
    }
} else {
    header("Location: ../err404.php");
}
