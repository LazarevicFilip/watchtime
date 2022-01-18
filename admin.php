<?php
session_start();
include_once("fixed/head.php");
if (isset($_SESSION['user']->uloga) == "Admin") {
    include_once("config/connection.php");
    include_once("models/functions.php");
    $admin = $_SESSION['user'];
    $allUsers = getAll("korisnici");
    $allPosts = getAll("postovi");
    $allCategories = getAll("kategorije");
} else {
    header("Location: err404.php");
}
?>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="index.php"><i class="fas fa-arrow-left"></i> WatchTime Admin Panel</a>
    </nav>

    <div class="container">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class=" pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link white-color" id="allUsers" href="#">
                                All users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link white-color" id="allPosts" href="#">
                                All posts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link white-color" id="allCats" href="#">
                                All categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link white-color" id="survey" href="#">
                                Survey
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <p class="lead">Admin : <?= $admin->ime . " " . $admin->prezime ?></p>
        </div>
    </main>
    <section>
        <div class="container  my-3">
            <div class="row mb-5">
                <div class="col-md-3 mr-4 cardd text-center p-3">
                    <i class="fas fa-user-friends fa-2x"></i>
                    <h4 class="p-1">Total users</h4>
                    <p class="lead"><?= count($allUsers) ?></p>
                </div>
                <div class="col-md-3 mr-4 cardd text-center p-3">
                    <i class="fas fa-mail-bulk fa-2x"></i>
                    <h4 class="p-1">Total posts</h4>
                    <p class="lead"><?= count($allPosts) ?></p>
                </div>
                <div class="col-md-3 mr-4 cardd text-center p-3">
                    <i class="fas fa-money-check fa-2x"></i>
                    <h4 class="p-1">Total categories</h4>
                    <p class="lead"><?= count($allCategories) ?></p>
                </div>
            </div>
        </div>
    </section>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <div id="msg"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12" id="survNum"></div>
            <div class="col-md-12" id="adminContent"></div>
        </div>
    </div>
    <?php
    $meni = getAll("meni");
    include("fixed/footer.php");
    ?>