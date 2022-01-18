<?php
session_start();
if (isset($_SESSION["user"]) && $_SESSION["user"]->uloga == "Admin") {
    include_once("../config/connection.php");
    include_once("functions.php");
    header('Content-type: application/json');
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
    $allUsers = getAllWithLimit($limit, "korisnici");
    $numberofPages = numberOfPagess("korisnici");
    if ($allUsers) {
        $output = '';
        $output .= "<h3>All Users</h3>";
        $output .= ' <table class="table table-dark">';
        $output .= ' <thead><tr>';
        $output .= ' <th scope="col">ID User</th>';
        $output .= ' <th scope="col">Full Name Post</th>';
        $output .= ' <th scope="col">Email</th>';
        $output .= ' <th scope="col">Date Registred</th>';
        $output .= ' <th scope="col">Delete</th>';
        foreach ($allUsers as $user) {
            $output .= "<tr>";
            $output .= "<th scope='row'>" . $user->id_korisnik . "</th>";
            $output .= "<td>" . $user->ime . " " . $user->prezime . "</td>";
            $output .= "<td>" . $user->email . "</td>";
            $output .= "<td>" . date("M d, Y", strtotime($user->vreme_registracije)) . "</td>";
            $output .= '<td><a href="#" class="btn btn-danger deleteUser white-color" data-iduser="' . $user->id_korisnik . '">Delete</a></td>';
        }
        $output .= '</table></div>';
        $output .= '<section>';
        $output .= '<div class="container">';
        $output .= '<div class="row">';
        $output .= ' <nav aria-label="Page navigation example" class="mx-auto">';
        $output .= ' <ul class="pagination">';
        for ($i = 0; $i < $numberofPages; $i++) {
            $output .= '<li class="page-item"><a class="page-link link-limit-user" data-idusers="' . $i . '" href="#">' . $i + 1 . '</a></li>';
        }
        $output .= '</ul></nav></div></div></section>';
        http_response_code(200);
        echo json_encode($output);
    } else {
        $msg = array("msg" => "There is no users right now.");
        http_response_code(500);
        echo json_encode($msg);
    }
}
