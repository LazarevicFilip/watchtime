<?php
include_once("config/connection.php");
include_once("fixed/head.php");
include_once("fixed/nav.php");
if (isset($_GET['id'])) {
    $path = "assets/uploaded_img/";
    $idPost = $_GET["id"];
    $singlePost = getSinglePost($idPost);
    // var_dump($singlePost);
    $commentsByPost = getComments($idPost);
    // var_dump($commentsByPost);
}
?>
<div class="container py-5 ">
    <div class="row ">
        <div class="mx-auto col-md-9">
            <img src=" <?= $path . $singlePost->src ?>" alt="<?= $singlePost->naziv ?>">
        </div>
    </div>
</div>
<div class="container my-5 ">
    <div class="row ">
        <div class="col-md-12">
            <span class="tag text-uppercase"><?= $singlePost->naziv ?></span>
            <h2 class="proba2 mt-2"><?= stripslashes($singlePost->naslov) ?></h2>
            <div class="row mt-3">
                <div class="col-md-3">
                    <p>By <?= $singlePost->ime . " " . $singlePost->prezime ?></p>
                </div>
                <div class="col-md-3">
                    <small><?= date("M d, Y", strtotime($singlePost->datum)) ?></small>
                </div>
                <div class="col-md-3">
                    <span class="ml-3"><?= count($commentsByPost) ?><i class="ml-1 fas fa-comment"></i></span>
                </div>
            </div>
            <p class="white-color"><?= stripslashes($singlePost->tekst) ?></p>
        </div>
    </div>
</div>
<div class="container mt-5">
    <h2 class="my-5">Comments:</h2>
    <?php
    if ($commentsByPost) :
    ?>
        <?php
        foreach ($commentsByPost as $comm) :
        ?>
            <div class="row">
                <div class="col-md-6"><?= $comm->ime . " " . $comm->prezime ?></div>
                <div class="col-md-6 text-right"><?= date("M d, Y", strtotime($comm->vreme_unosa)) ?></div>
            </div>
            <div class="row my-3 py-3">
                <div class="col-md-12 white-color">
                    <?= stripslashes($comm->tekst)  ?>
                </div>
            </div>
            <hr>
        <?php
        endforeach;
        ?>
    <?php else : ?>
        <div class="container">
            <div class="row">
                <h5 class="white-color">No comments yet...</h5>
            </div>
        </div>
    <?php
    endif;
    ?>

</div>
<hr>
<?php
if (isset($_SESSION["user"])) :
?>
    <div class="container">
        <h4 class="white-color mb-3">Leave a comment:</h4>
        <div class="row">
            <div class="col-md-6">
                <form>
                    <textarea id="taComment" cols="50" rows="8" placeholder="Comment here" class="from-control p-2 w-100" data-idPost="<?= $singlePost->id ?>"></textarea><br>
                    <small class="form-text text-danger hide">This field can't be blank.</small>
                    <input type="button" id="btnComm" class="btn btn-primary mt-3" value="Comment">
                </form>
                <div id="msg"></div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="container">
        <div class="row">
            <div class="my-3">
                <h4>You must be registerd to leave a comment...</h4>
            </div>
        </div>
    </div>
<?php
endif
?>
<?php
include_once("fixed/footer.php");
?>