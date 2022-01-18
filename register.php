<?php
include_once("fixed/head.php");
include_once("fixed/nav.php");
include_once("config/connection.php");
?>
<section class="showcase-other mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7 mt-5 p-4 ">
                <h1>Register</h1>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h3 class="text-center mb-4">Sign Up</h3>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fname">Frist Name</label>
                            <input type="text" class="form-control" id="fname">
                            <small class="form-text text-danger hide">E.q John</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" id="lname">
                            <small class="form-text text-danger hide">E.q. Doe</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="emailRegister">Email</label>
                        <input type="text" class="form-control" id="emailRegister">
                        <small class="form-text text-danger hide">E.q. johndoe@something.com</small>

                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password">
                        <small class="form-text text-danger hide">Password must contain minimum eight characters, at least one uppercase letter, one lowercase letter and one number.</small>
                    </div>
                    <div class="form-group">
                        <label for="passwordRe">Confirm Password</label>
                        <input type="password" class="form-control" id="passwordRe">
                        <small class="form-text text-danger hide">Password don't match</small>
                    </div>

                    <input type="button" id="btnReg" class=" btn btn-primary" value="Submit" />
                </form>
                <div id="msg"></div>
            </div>
        </div>
    </div>
</section>
<?php
include_once("fixed/footer.php");
?>