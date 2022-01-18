<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-type: application/json");
    include_once("../config/connection.php");
    include("functions.php");
    try {

        $fName = addslashes($_POST["fnameUI"]);
        $lName = addslashes($_POST["lnameUI"]);
        $email = addslashes($_POST["emailUI"]);
        $password = $_POST["passwordUI"];
        $passwordRe = $_POST["passwordReUI"];

        $err = 0;

        $reFristName = "/^([A-Z][a-z]{2,15})+$/";
        $reLastName = "/^([A-Z][a-z]{2,20})+$/";
        $reEmail = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";
        $rePassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";

        if (isset($fName)) {
            if (!preg_match($reFristName, $fName)) {
                $err++;
            }
        }
        if (isset($lName)) {
            if (!preg_match($reLastName, $lName)) {
                $err++;
            }
        }
        if (isset($email)) {
            if (!preg_match($reEmail, $email)) {
                $err++;
            }
        }
        if (isset($password)) {
            if (!preg_match($rePassword, $password)) {
                $err++;
            }
        }
        if (isset($passwordRe)) {
            if (!preg_match($rePassword, $passwordRe)) {
                $err++;
            }
        }
        if ($password !== $passwordRe) {
            $err++;
        }
        $msg = '';
        if ($err == 0) {
            try {
                $encryptedPass = md5($passwordRe);
                $status = 0;
                $roleId = 2;
                $insert = insertUser($fName, $lName, $email, $encryptedPass, $status, $roleId);
                if ($insert) {
                    $msg = ['msg' => 'You have successfully registered'];
                    echo json_encode($msg);
                    http_response_code(201);
                }
            } catch (PDOException $exception) {
                http_response_code(500);
                $msg = ['msg' => "Oops,Email that you entered already exist."];
                echo json_encode($msg);
            }
        }
    } catch (PDOException $exception) {
        http_response_code(500);
    }
} else {
    header("Location: ../err404.php");
}
