<?php
include_once("fixed/head.php");
include_once("fixed/nav.php");
include_once("config/connection.php");
include_once("models/functions.php");
if (!isset($_SESSION['user'])) {
    header('Location: err404.php');
}
$kategorije = getAll("kategorije");
// var_dump($kategorije);
?>
<section class="showcase-other mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7 mt-5 p-4 ">
                <h1>Create Post</h1>
            </div>
        </div>
    </div>
</section>
<?php
if (isset($_SESSION["user"])) {
    $korisnik = $_SESSION["user"];
    echo "<div class='container'>
    <div class='row'>
        <div class='col-md-12 lead'><h4>Hello {$korisnik->ime},</h4></div>
    </div></div>";
}
if (isset($_GET["success"])) {
    echo "<div class='container'>
    <div class='row'><p class='alert alert-success col-md-6 mt-3'>You have successfully post a blog.</p></div>
</div>";
}
?>

<section class="mb-5">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12 mt-5 ">
                <h2 class="my-1 ">Tell us your passion about watches.</h2>
                <p class="mt-3 lead">Share your story and make sure other people see!</p>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container text-center ">
        <div class="row">
            <div class="col-md-8 mx-auto  mt-4">
                <form action="models/upload&editPost.php" method="POST" enctype="multipart/form-data" onsubmit="return checkPost();">
                    <div class="form-group col-md-10">
                        <label for="postTitle">Title</label>
                        <input type="text" name="title" class="w-100 form-control" id="postTitle">
                        <small class="form-text text-danger hide">Title must start with a capital letter and must be in range [3-80] characters</small>
                    </div>
                    <div class="form-group col-md-10 mt-4">
                        <label for="ddl">Category:</label>
                        <select name="ddlKat" id="ddl" class="form-control">
                            <option value="0">Please select</option>
                            <?php
                            foreach ($kategorije as $kat) :
                            ?>
                                <option value="<?= $kat->id_kategorije ?>"><?= $kat->naziv ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <small class="form-text text-danger hide">You must choose category</small>
                    </div>
                    <div class="form-group col-md-10">
                        <label for="tekstPost">Post content:</label>
                        <textarea name="taPost" id="tekstPost" class="form-control" rows="12"></textarea>
                        <small class="form-text text-danger hide">Content must contain at least 150 characters.</small>
                    </div>
                    <div class="form-group col-md-10">
                        <label for="imgPost">Image:</label>
                        <input type="file" name="filePost" id="file" class="form-control-file">
                        <small class="form-text text-danger hide">You must choose image</small>
                    </div>
                    <div class="form-group col-md-10">
                        <input type="submit" value="Create Post" name="btnSubmit" class="btn btn-primary  w-100">
                    </div>
                </form>
                <?php
                if (isset($_SESSION["errType"])) {
                    echo "<p class='alert alert-danger col-md-6 mt-3'>" . $_SESSION["errType"] . "</p>";
                    unset($_SESSION["errType"]);
                }
                if (isset($_SESSION["errSize"])) {
                    echo "<p class='alert alert-danger col-md-6 mt-3'>" . $_SESSION["errSize"] . "</p>";
                    unset($_SESSION["errSize"]);
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php
include_once("fixed/footer.php");
?>