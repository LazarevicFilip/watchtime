<?php
global $meni;
?>
<footer class="section-footer mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <?php
                if (isset($_SESSION["user"])) {
                    $survey = getActiveSurvey();
                    echo "<h4>$survey->pitanje</h4>";
                    echo "<input type='hidden' id='hiddenSurvey' value='$survey->id_anketa'>";
                    $options = getOptions($survey->id_anketa);
                    foreach ($options as $option) {
                        echo "<div class='form-check m-2'>
                        <input class='form-check-input' type='radio' name='rb' id='exampleRadios1' value='$option->id_odgovor'>
                        <label class='form-check-label' for='exampleRadios1'>
                          $option->odgovor
                        </label>
                      </div>";
                    }
                    echo "<button type='button' id='btnSend' class='btn btn-primary my-1'>Send</button>";
                }
                ?>
                <h2>WatchTime</h2>
                <a href="https://www.twitter.com/" target="_blank"><i class="fab fa-twitter fa-2x"></i></a>
                <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube fa-2x"></i></a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3>Company Info</h3>
                <ul>
                    <?php
                    for ($i = 0; $i < count($meni); $i++) {
                        if (isset($_SESSION["user"])) {
                            if ($_SESSION["user"]->uloga == "Korisnik" && stripos($meni[$i]->naziv, "admin") == "" && stripos($meni[$i]->naziv, "login") == "" && (stripos($meni[$i]->naziv, "register")) == "") {
                                echo ("<li>
                                        <a href='{$meni[$i]->putanja}'>{$meni[$i]->naziv}</a>
                                    </li>");
                            } else if ($_SESSION["user"]->uloga == "Admin" && stripos($meni[$i]->naziv, "login") == "" && (stripos($meni[$i]->naziv, "register")) == "") {
                                echo ("<li>
                                    <a href='{$meni[$i]->putanja}'>{$meni[$i]->naziv}</a>
                                </li>");
                            }
                        } else {
                            if (stripos($meni[$i]->naziv, "admin") == "" && stripos($meni[$i]->naziv, "profile") == "" && stripos($meni[$i]->naziv, "new post") == "" && stripos($meni[$i]->naziv, "log out") == "") {
                                echo ("<li >
                                        <a href='{$meni[$i]->putanja}'>{$meni[$i]->naziv}</a>
                                        </li>");
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3>Useful Links</h3>
                <ul>
                    <li><a href="assets/xml/sitemap.xml">Sitemap</a></li>
                    <li><a href="watchtime1.pdf">Documentation</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3>Subscribe</h3>
                <p>Subscribe to our newsletter.</p>
                <form name=email-form method="POST" date-netlify='true'>
                    <div class="email-form">
                        <input type="email" name="email" id="emailFooter" class="control" placeholder="Email" size='40'>
                        <button type="submit" value="Submit" class="form-control submit">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="assets/js/main.js" type="text/javascript"></script>
</body>

</html>