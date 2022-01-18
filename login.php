<?php
include_once("fixed/head.php");
include_once("fixed/nav.php");
include_once("config/connection.php");
// session_start();
?>
<section class="showcase-other mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5 p-4 ">
                <h1>Login</h1>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h3 class="text-center my-3">Sign In</h3>
                <form class="mb-5">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email">
                        <small class="form-text text-danger hide">Please enter a valid email adress.</small>
                    </div>
                    <div class="form-group">
                        <label for="passwordLog">Password</label>
                        <input type="password" class="form-control" id="passwordLog">
                        <small class="form-text text-danger hide">Please enter a valid password.</small>
                    </div>
                    <p>Don't have account? <a href="register.php" class="link">Sign Up Here.</a></p>
                    <input type="button" id="btnLog" class="btn btn-primary" value="Submit" />
                    <div id="msg"></div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
include_once("fixed/footer.php");
?>