<?php
include_once("fixed/head.php");
include_once("fixed/nav.php");
?>
<section class="showcase-other mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7 mt-5 p-4 ">
                <h1>Send a message</h1>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <h3 class="mb-2 white-color">You have a question or you just want to tell us your opinion.</h3>
        <p class="lead white-color">Send a message...</p>
        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject">
                            <small class="form-text text-danger hide">This field can't be blank</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="emailMsg">Email</label>
                            <input type="text" class="form-control" id="emailMsg">
                            <small class="form-text text-danger hide">E.q. johndoe@something.com</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" class="form-control" rows="12"></textarea>
                        <small class="form-text text-danger hide">Message must contain at least 20 characters.</small>
                    </div>

                    <input type="button" id="btnMsg" class=" btn btn-primary" value="Submit" />
                </form>
                <div id="msg"></div>
            </div>
        </div>
    </div>
</section>


<?php
include_once("fixed/footer.php")
?>