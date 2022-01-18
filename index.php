<?php
include_once("fixed/head.php");
include_once("fixed/nav.php");
include_once("config/connection.php");
include_once("models/functions.php");
$newPosts = getNewestPosts();
// var_dump($newPosts);
$path = "assets/uploaded_img/";
$mostCommentPost = mostPopularPost();
// var_dump($mostCommentPost);
?>
<section class="showcase">
    <div class="container">
        <div class="row">
            <div class="col-md-7 mt-5 p-4 ">
                <h2 class="mt-5">WatchTime Blog</h2>
                <p class="mt-4">Welcome to WatchTime’s blog – the watch collector’s daily resource for the latest news on watches and the watch industry.We are one of the most popular watch blogs in Europe!</p>
                <a href="blog.php" class="my-btn mt-2  font-weight-bold rounded-pill">See More</a>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-post">Newest Stories<span class="line"></span></h3>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <?php
            foreach ($newPosts as $post) :
                $shortDesc = substr($post->tekst, 0, 200);
                $shortDesc = stripslashes($shortDesc);
                $commentsByPost = getComments($post->id);
            ?>
                <div class="col-md-6 col-lg-4 col-sm-12 my-4">
                    <div class="cardd">
                        <div class="card-header">
                            <a href="blog-details.php?id=<?= $post->id ?>">
                                <img src=" <?= $path . $post->src ?>" alt="<?= $post->naslov ?>" />
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="w-100 d-flex justify-content-between">
                                <span class="tag"><?= $post->naziv ?></span>
                                <span class="ml-3"><?= count($commentsByPost) ?><i class="ml-1 fas fa-comment"></i></span>
                            </div>
                            <a href="blog-details.php?id=<?= $post->id ?>">
                                <h4><?= stripslashes($post->naslov) ?></h4>
                            </a>
                            <p><?= $shortDesc ?> <a class="link" href="blog-details.php?id=<?= $post->id ?>">See more...</a></p>
                            <div class="user">
                                <div class="user-info">
                                    <h5><?= $post->ime . " " . $post->prezime ?></h5>
                                    <small><?= date("M d, Y", strtotime($post->datum)) ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>
</section>
<section class="baner my-5">
</section>
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-post">Most commented blogs<span class="line"></span></h3>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <?php
            foreach ($mostCommentPost as $post) :
                $shortDesc = substr($post->tekst, 0, 200);
                $shortDesc = stripslashes($shortDesc);
                $commentsByPost = getComments($post->id);
            ?>
                <div class="col-md-6 col-lg-4 col-sm-12 my-4">
                    <div class="cardd">
                        <div class="card-header">
                            <a href="blog-details.php?id=<?= $post->id ?>">
                                <img src=" <?= $path . $post->src ?>" alt="<?= $post->naslov ?>" />
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="w-100 d-flex justify-content-between">
                                <span class="tag"><?= $post->naziv ?></span>
                                <span class="ml-3"><?= count($commentsByPost) ?><i class="ml-1 fas fa-comment"></i></span>
                            </div>
                            <a href="blog-details.php?id=<?= $post->id ?>">
                                <h4><?= stripslashes($post->naslov) ?></h4>
                            </a>
                            <p><?= $shortDesc ?> <a class="link" href="blog-details.php?id=<?= $post->id ?>">See more...</a></p>
                            <div class="user">
                                <div class="user-info">
                                    <h5><?= $post->ime . " " . $post->prezime ?></h5>
                                    <small><?= date("M d, Y", strtotime($post->datum)) ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>
</section>


<?php
include_once("fixed/footer.php");
?>