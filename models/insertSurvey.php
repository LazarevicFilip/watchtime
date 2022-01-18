<?php
session_start();
if (
    isset($_POST["addSurvey"]) && isset($_SESSION["user"]) && $_SESSION["user"]->uloga == "Admin" &&
    $_SERVER['REQUEST_METHOD'] == 'POST'
) {
    include_once '../config/connection.php';
    include_once 'functions.php';
    $answer = $_POST['answer'];
    $question = $_POST['question'];
    $questionRe = "/^([A-Z]|[0-9])[\sA-Za-z\d.?,!_-]{2,48}$/";
    $err = 0;
    if (is_array($answer)) {
        foreach ($answer as $a) {
            if (!preg_match($questionRe, $a)) {
                $_SESSION['surrErr1'] = 'Answer must contain only letters
                    and must start with a capital letter.';
                header('Location: ../admin.php');
                die();
            }
        }
    }
    if (isset($question)) {
        if (!preg_match($questionRe, $question)) {
            $_SESSION['surrErr2'] = 'Question must contain only letters,
           question mark and must start with a capital letter.';
            header("Location: ../admin.php");
            die();
        }
    }
    $insertSurv = insertSurv($question);
    global $conn;
    $lastId = $conn->lastInsertId();
    $errArray = [];
    foreach ($answer as $b) {
        $insertAnswers = insertAnswers($lastId, $b);
        if (!$insertAnswers) {
            $errArray[] = "Error with server";
        }
    }
    if (!count($errArray)) {
        $_SESSION['insertedSurvey'] = 'You have successfully added a survey.';
        header('Location: ../admin.php');
        die();
    } else {
        $_SESSION['errInserting'] = 'There was an error inserting a new
           survey.';
        header('Location: ../admin.php');
        die();
    }
} else {
    header('Location: ../err404.php');
}
