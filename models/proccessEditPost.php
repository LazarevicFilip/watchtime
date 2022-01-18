<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btnSubmit"]) && isset($_SESSION["user"])) {
    include_once "../config/connection.php";
    include "functions.php";

    $file = $_FILES['filePost'];
    $name = $file["name"];
    $tmpFIle = $file["tmp_name"];
    $size = $file["size"];
    $type = $file["type"];
    $errFile = $file["error"];

    $title = addslashes($_POST["title"]);
    $titleRe = "/^([A-Z]|[0-9])[\sA-z\d.?,!_-]{2,78}$/";

    $category = $_POST["ddlKat"];
    $desc = addslashes($_POST["taPost"]);
    $err = 0;
    //title provera
    if (isset($title)) {
        if (!preg_match($titleRe, $title)) {
            $err++;
        }
    }
    //katID provera
    $allCat = getAll("kategorije");
    $arrCat = [];
    foreach ($allCat as $c) {
        $arrCat[] = $c->id_kategorije;
    }
    if (!in_array($category, $arrCat)) {
        $err++;
    }
    //desc provera
    if (isset($desc)) {
        if (strlen($desc) < 100) {
            $err++;
        }
    }
    if ($err == 0 && $errFile == 0) {
        $uploadErr = 0;
        $imgFormat = ["image/jpg", "image/jpeg", "image/png"];
        if (!in_array($type, $imgFormat)) {
            $uploadErr++;
            $_SESSION['errType'] = "Image format must be .jpg, .jpeg, .png ";
        }

        if ($size > 200000) {
            $uploadErr++;
            $_SESSION['errSize'] = "Image can't be larger then 2mb";
        }
        if ($uploadErr == 0) {
            $newFileName = time() . "-" . $name;
            $path = "../assets/uploaded_img/" . $newFileName;
            if (move_uploaded_file($tmpFIle, $path)) {
                $korisnik = $_SESSION["user"];
                $insertPost = insertPost($title, $desc, $korisnik->id, $category, $newFileName);
                if ($insertPost) {
                    header("Location: ../newpost.php?success=1");
                }
            }
        } else {
            header("Location: ../newpost.php");
        }
    }
}
