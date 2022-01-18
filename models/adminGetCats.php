<?php
session_start();
if (isset($_SESSION["user"]) && $_SESSION["user"]->uloga == "Admin") {
    include_once("../config/connection.php");
    include_once("functions.php");
    header('Content-type: application/json');
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
    $allCats = getAllWithLimit($limit, "kategorije");
    $numberofPages = numberOfPagess("kategorije");
    if ($allCats) {
        $output = '';
        $output .= "<h3>All Categories</h3>";
        $output .= '<div class=" d-flex justify-content-end  my-2 py-2">';
        $output .= '<input type="text" class="form-control mx-2" id="addCategories">';
        $output .= '<input type="button" id="addCat" class="btn btn-primary white-color" value="Add category"/>';
        $output .= '</div>';
        $output .= ' <table class="table table-dark">';
        $output .= ' <thead><tr>';
        $output .= ' <th scope="col">ID Category</th>';
        $output .= ' <th scope="col">Category Name </th>';
        $output .= ' <th scope="col">Delete</th>';
        foreach ($allCats as $cats) {
            $output .= "<tr>";
            $output .= "<th scope='row'>" . $cats->id_kategorije . "</th>";
            $output .= "<td>" . $cats->naziv . "</td>";
            $output .= '<td><a href="#" class="btn btn-danger deleteCat white-color" data-idcat="' . $cats->id_kategorije . '">Delete</a></td>';
        }
        $output .= '</table></div>';
        $output .= '<section>';
        $output .= '<div class="container">';
        $output .= '<div class="row">';
        $output .= ' <nav aria-label="Page navigation example" class="mx-auto">';
        $output .= ' <ul class="pagination">';
        for ($i = 0; $i < $numberofPages; $i++) {
            $output .= '<li class="page-item"><a class="page-link link-limit-cats" data-idcats="' . $i . '" href="#">' . $i + 1 . '</a></li>';
        }
        $output .= '</ul></nav></div></div></section>';
        http_response_code(200);
        echo json_encode($output);
    } else {
        $msg = array("msg" => "There is no categories right now.");
        http_response_code(500);
        echo json_encode($msg);
    }
}
