<?php
include("php.ini");
try {
    $conn = new PDO("mysql:host=$serverBaze;dbname=$bazaPodataka;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo $e->getMessage();
}
