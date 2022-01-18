<?php
session_start();
if (isset($_SESSION["user"]) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once '../config/connection.php';
    include_once 'functions.php';
    $idAnswear = $_POST["idAnswear"];
    $idSurvey = $_POST["idSurvey"];
    $idUser = $_SESSION["user"]->id;
    $insertAnswear = insertAnswers($idAnswear, $idSurvey, $idUser);
    if ($insertAnswear) {
        $_SESSION['surveySucc'] = 'Thank you for answering our survey!';
    } else {
        $_SESSION['surveyErr'] = 'There was an error with getting your
survey data.';
    }
} else {
    header("Location: ../err404.php");
}
