<?php
include_once("fixed/head.php");
include_once("fixed/nav.php");
include_once("config/connection.php");
include_once("models/functions.php");
// var_dump($posts);
$path = "assets/uploaded_img/";
$limit = isset($_GET['page']) ? $_GET['page'] : 0;

$posts = getAllPostsWithCatandAuthor($limit);
?>
<section class="showcase-other mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7 mt-5 p-4 ">
                <h1 class="logo">Blogs</h1>
                <p class="lead mt-3">News and stories for all watch enthusiast</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row">
            <?php
            foreach ($posts as $post) :
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
$numberofPages = numberOfPagess("postovi");
?>
<section>
    <div class="container ">
        <div class="row">
            <nav aria-label="Page navigation example" class="ml-auto">
                <ul class="pagination">
                    <?php
                    for ($i = 0; $i < $numberofPages; $i++) :
                    ?>
                        <li class="page-item"><a class="page-link" href="blog.php?page=<?= $i ?>"><?= $i + 1 ?></a></li>
                    <?php
                    endfor;
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</section>


<?php
include_once("fixed/footer.php");
?>