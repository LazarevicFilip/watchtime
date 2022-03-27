<?php
session_start();
if (isset($_SESSION["user"]) && $_SESSION["user"]->uloga == "Admin") {
    include_once("../config/connection.php");
    include_once("functions.php");
    header('Content-type: application/json');
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
    $allPosts = getAllPostsWithCatandAuthor($limit);
    $numberofPages = numberOfPagess("postovi");
    if ($allPosts) {
        $output = '';
        $output .= "<h3>All Posts</h3>";
        $output .= ' <table class="table table-dark">';
        $output .= ' <thead><tr>';
        $output .= ' <th scope="col">ID Post</th>';
        $output .= ' <th scope="col">Post</th>';
        $output .= ' <th scope="col">User</th>';
        $output .= ' <th scope="col">Date Of Posting</th>';
        $output .= ' <th scope="col">Delete</th>';
        foreach ($allPosts as $post) {
            $output .= "<tr>";
            $output .= "<th scope='row'>" . $post->id . "</th>";
            $output .= "<td>" . $post->naslov . "</td>";
            $output .= "<td>" . $post->ime . " " . $post->prezime . "</td>";
            $output .= "<td>" . date("M d, Y", strtotime($post->datum)) . "</td>";
            $output .= '<td><a href="#" class="btn btn-danger deletePost white-color" data-idpost="' . $post->id . '">Delete</a></td>';
       
        }
        $output .= '</table></div>';
        $output .= '<section>';
        $output .= '<div class="container">';
        $output .= '<div class="row">';
        $output .= ' <nav aria-label="Page navigation example" class="mx-auto">';
        $output .= ' <ul class="pagination">';
        for ($i = 0; $i < $numberofPages; $i++) {
            $output .= '<li class="page-item"><a class="page-link link-limit-post" data-idpos="' . $i . '" href="#">' . $i + 1 . '</a></li>';
        }
        $output .= '</ul></nav></div></div></section>';
        http_response_code(200);
        echo json_encode($output);
    } else {
        $msg = array("msg" => "There is no posts right now.");
        http_response_code(500);
        echo json_encode($msg);
    }
}
