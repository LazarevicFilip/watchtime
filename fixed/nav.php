<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand text-uppercase font-weight-bold" href="#">Watch<span class="logo">Time</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-uppercase" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <?php
                    include_once("config/connection.php");
                    include("models/functions.php");
                    // session_start();
                    $meni = getAll("meni");
                    for ($i = 0; $i < count($meni); $i++) {
                        if (isset($_SESSION["user"])) {
                            if ($_SESSION["user"]->uloga == "Korisnik" && stripos($meni[$i]->naziv, "admin") == "" && stripos($meni[$i]->naziv, "login") == "" && (stripos($meni[$i]->naziv, "register")) == "") {
                                echo ("<li class='nav-item active mr-2'>
                                <a class='nav-link' href='{$meni[$i]->putanja}'>{$meni[$i]->naziv}</a>
                            </li>");
                            } else if ($_SESSION["user"]->uloga == "Admin" && stripos($meni[$i]->naziv, "login") == "" && (stripos($meni[$i]->naziv, "register")) == "") {
                                echo ("<li class='nav-item active mr-2'>
                            <a class='nav-link' href='{$meni[$i]->putanja}'>{$meni[$i]->naziv}</a>
                        </li>");
                            }
                        } else {
                            if (stripos($meni[$i]->naziv, "admin") == "" && stripos($meni[$i]->naziv, "profile") == "" && stripos($meni[$i]->naziv, "new post") == "" && stripos($meni[$i]->naziv, "log out") == "") {
                                echo ("<li class='nav-item active mr-2'>
                                <a class='nav-link' href='{$meni[$i]->putanja}'>{$meni[$i]->naziv}</a>
                                </li>");
                            }
                        }
                    }

                    ?>
                </ul>
            </div>
        </nav>
    </div>