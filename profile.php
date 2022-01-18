<?php
include_once("fixed/head.php");
include_once("fixed/nav.php");
include_once("config/connection.php");
include_once("models/functions.php");
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    $rowsInTable = countRowsForUser($user->id);
    $numberofPages = numberOfPagesForUser($rowsInTable);

    $limit = isset($_GET['page']) ? $_GET['page'] : 0;
    $allPostsForUser = allPostsForUSer($user->id, $limit);
    // var_dump($allPostsForUser);

} else {
    header("Location: err404.php");
}
?>
<section class="showcase-other mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7 mt-5 p-4 ">
                <h1>My profile</h1>
            </div>
        </div>
    </div>
</section>
<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h2 class="white-color mb-3">User information:</h2>
                <div class="d-flex">
                    <p class="lead">User:</p>
                    <p class="mx-1 lead"><?= $user->ime . " " . $user->prezime ?></p>
                </div>
                <div class="d-flex">
                    <p class="lead">Email:</p>
                    <p class="mx-1 lead"><?= $user->email ?></p>
                </div>
                <div class="d-flex">
                    <p class="lead">User ID:</p>
                    <p class="mx-1 lead"><?= $user->id ?></p>
                </div>
                <div class="d-flex">
                    <p class="lead">Member since:</p>
                    <p class="mx-1 lead"><?= date("M d, Y", strtotime($user->vreme)) ?></p>
                </div>
                <div class="d-flex">
                    <p class="lead">Role:</p>
                    <p class="mx-1 lead"><?= $user->uloga ?></p>
                </div>
            </div>
            <?php
            if (isset($_GET["edited"])) {
                echo "<div class='col-md-1 p-2'><p class='alert alert-success'>Edited</p></div>";
            }
            ?>

            <div class="col-md-4" id="msg"></div>
            <div class="col-md-12  mt-3">
                <h2 class="white-color mb-3">All posts:</h2>
                <?php
                if ($allPostsForUser) :
                ?>
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">ID Post</th>
                                <th scope="col">Post</th>
                                <th scope="col">Date</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($allPostsForUser as $post) :
                            ?>
                                <tr>
                                    <th scope="row"><?= $post->id_post ?></th>
                                    <td><?= $post->naslov ?></td>
                                    <td><?= date("M d, Y", strtotime($post->datum)) ?></td>
                                    <td><a href="edit-post.php?id=<?= $post->id_post ?>" class="btn btn-primary editPost white-color">Edit</a></td>
                                    <td><a href="#" class="btn btn-danger deletePost white-color" data-idpost="<?= $post->id_post ?>">Delete</a></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                    <section>
                        <div class="container">
                            <div class="row">
                                <nav aria-label="Page navigation example" class="mx-auto">
                                    <ul class="pagination">
                                        <?php
                                        for ($i = 0; $i < $numberofPages; $i++) :
                                        ?>
                                            <li class="page-item"><a class="page-link" href="profile.php?page=<?= $i ?>"><?= $i + 1 ?></a></li>
                                        <?php
                                        endfor;
                                        ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </section>
                <?php else : ?>
                    <p class="lead">You don't have any posts...</p>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
<?php
include_once("fixed/footer.php")
?>