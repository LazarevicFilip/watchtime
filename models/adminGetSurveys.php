<?php
session_start();
if (isset($_SESSION["user"]) && $_SESSION["user"]->uloga == "Admin") {
    include_once("../config/connection.php");
    include_once("functions.php");
    header('Content-type: application/json');
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
    $allSurv = getAllWithLimit($limit, "anketa");
    $numberofPages = numberOfPagess("anketa");
    if ($allSurv) {
        $output = '';
        $output .= "<h3>All Surveys</h3>";
        $output .= '<div class=" d-flex justify-content-end  my-2 py-2">';
        $output .= '<input type="button" id="addSurv" class="btn btn-primary white-color" value="Add survey"/>';
        $output .= '</div>';
        $output .= ' <table class="table table-dark">';
        $output .= ' <thead><tr>';
        $output .= ' <th scope="col">ID Survey</th>';
        $output .= ' <th scope="col">Question </th>';
        $output .= ' <th scope="col">Enable/Disable</th>';
        $output .= ' <th scope="col">Delete</th>';
        foreach ($allSurv as $surv) {
            $output .= "<tr>";
            $output .= "<th scope='row'>" . $surv->id_anketa . "</th>";
            $output .= "<td>" . $surv->pitanje . "</td>";
            if ($surv->aktivna == 1) {
                $output .= '<td><a href="#" class="btn btn-danger disableSurv white-color" data-idsurv="' . $surv->id_anketa . '">Disable</a></td>';
            } else {
                $output .= '<td><a href="#" class="btn btn-primary enableSurv white-color" data-idsurv="' . $surv->id_anketa . '">Enable</a></td>';
            }
            $output .= '<td><a href="#" class="btn btn-danger deleteSurv white-color" data-idsurv="' . $surv->id_anketa . '">Delete</a></td>';
        }

        $output .= '</tr></table></div>';
        $output .= '<section>';
        $output .= '<div class="container">';
        $output .= '<div class="row">';
        $output .= ' <nav aria-label="Page navigation example" class="mx-auto">';
        $output .= ' <ul class="pagination">';
        for ($i = 0; $i < $numberofPages; $i++) {
            $output .= '<li class="page-item"><a class="page-link link-limit-survey" data-idsurv="' . $i . '" href="#">' . $i + 1 . '</a></li>';
        }
        $output .= '</ul></nav></div></div></section>';
        http_response_code(200);
        echo json_encode($output);
    } else {
        $msg = array("msg" => "There is no surveys right now.");
        http_response_code(500);
        echo json_encode($msg);
    }
}
