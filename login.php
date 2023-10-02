<?php

    // Database
    include("config/config.php");

?>

<!DOCTYPE html>
<html lang="en" style="height: 100%;">
    <head>
        <meta charset=utf-8>
        <meta http-equiv=X-UA-Compatible content="IE=edge">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <meta name=description content="">
        <meta name=author content="">
        <title><?php echo $contentPageTitle; ?></title>
        <?php
            // ================
            // CSS
            // ================ 
            echo $contentPageCSS; 
        ?>
    </head>
    <body style="
        height: 100%;
        background-image: url('assets/images/bg.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    ">
        <!-- Content Wrapper -->
        <div class="login-wrapper">
            <div class="container-center">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <center><img src="<?php echo $contentPageLogoLarge; ?>" height="250" width="250"></center>
                        <div class="view-header" style="margin-bottom: 10px;">
                            <div class="header-icon">
                                <i class="pe-7s-unlock text-danger"></i>
                            </div>
                            <div class="header-title">
                                <h3>Login</h3> <br>
                                <small><strong>Please enter your credentials to login.</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form id="fInfo" method="post" enctype="multipart/form-data">
                            <!--Social Buttons--> 
                            <div class="form-group">
                                <label class="control-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="username" type="text" class="form-control" name="uuname" placeholder="Username" autocorrect="off" autocapitalize="none">
                                </div>
                                <span class="help-block small">Your account username</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input id="pass" type="password" class="form-control" name="upword" placeholder="******" autocorrect="off" autocapitalize="none">
                                </div>
                                <span class="help-block small">Your account password</span>
                            </div>
                            <div>
                                <button class="btn btn-danger btn-block pull-right" type="button" id="fSubmit" name="fSubmit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <?php
            // ================
            // JS
            // ================
            echo $contentPageJS; 
        ?>

        <script>
            $(document).ready(function(){
                // Load
                $('#cArea').select2();
                LoadForm();

                // Press - Submit
                $('#fSubmit').click(function(e) {
                    // form
                    $.ajax({
                        type: "POST",
                        url: "server/api.php?mode=userlogin",
                        data: $("#fInfo").serialize(),
                        beforeSend: function() {
                            // button
                            $('#fSubmit').toggle();
                        },
                        success: function(data) {
                            // button
                            $('#fSubmit').toggle();

                            // result
                            const result = JSON.parse(data);

                            // check
                            if (result.status == "ok")
                            {
                                //message
                                //swal("Added!", result.message, "success");
                                localStorage.setItem("tokenId", result.data);
                                window.location.href = "ovenview.php?id=1";
                            }
                            else
                            {
                                // message
                                swal("Error!", result.message, "error");
                            }
                        },
                        error: function(data) {
                            // button
                            $('#fSubmit').toggle();

                            // message
                            swal("Error!", "Something went wrong. Please try again.", "error");
                        }
                    });
                });
            });


            // Function
            // -------------------------
            // Load Form
            function LoadForm()
            {
                $('#fInfo')[0].reset();
            }
        </script>
    </body>
</html>