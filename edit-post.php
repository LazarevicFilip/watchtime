<?php
include_once("fixed/head.php");
include_once("fixed/nav.php");
if (isset($_SESSION['user'])) {
    include_once("config/connection.php");
    if (isset($_GET['id'])) {
        $idPost = $_GET["id"];
        $kategorije = getAll("kategorije");
        $singlePost = getSinglePost($idPost);
    }
}
?>
<section class="showcase-other mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7 mt-5 p-4 ">
                <h1>Edit Post</h1>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container mx-auto">
        <div class="row">
            <div class="col-md-12">
                <form action="models/upload&editPost.php" method="POST" enctype="multipart/form-data" onsubmit="return checkEditedPost();">
                    <div class="form-group col-md-12">
                        <label for="postTitle">Title</label>
                        <input type="text" name="title" class="form-control" id="editTitle" value="<?= stripslashes($singlePost->naslov) ?>">
                        <small class="form-text text-danger hide">Title must start with a capital letter and must be in range [3-80] characters</small>
                    </div>
                    <div class="form-group col-md-12 mt-4">
                        <label for="ddl">Category:</label>
                        <select name="ddlKat" id="ddlEdit" class="form-control">
                            <option value="0">Please select</option>
                            <?php
                            foreach ($kategorije as $kat) :
                            ?>
                                <?php
                                if ($kat->id_kategorije == $singlePost->id_kategorije) :
                                ?>
                                    <option value="<?= $kat->id_kategorije ?>" selected><?= $kat->naziv ?></option>
                                <?php else : ?>
                                    <option value="<?= $kat->id_kategorije ?>"><?= $kat->naziv ?></option>
                                <?php
                                endif;
                                ?>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <small class="form-text text-danger hide">You must choose category</small>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="editText">Post content:</label>
                        <textarea name="taPost" id="editText" class="form-control" rows="12"><?= stripslashes($singlePost->tekst) ?></textarea>
                        <small class="form-text text-danger hide">Content must contain at least 150 characters.</small>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="imgPost">Image:</label>
                        <input type="file" name="filePost" id="editFile" class="form-control-file">
                        <small class="form-text text-danger hide">You must choose image</small>
                    </div>
                    <div class="form-group col-md-12">
                        <input type="hidden" name="postID" value="<?= $singlePost->id ?>">
                        <input type="submit" value="Edit Post" name="editSubmit" class="btn btn-primary  w-100">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<?php
include_once("fixed/footer.php");
?>