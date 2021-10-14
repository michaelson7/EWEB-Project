<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <?php require_once("includes/header.php"); ?>
</head>

<body class="sb-nav-fixed ">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input name="email" class="form-control py-4" id="inputEmailAddress" type="email" placeholder="Enter email address" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input name="password" class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" />
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.php">Forgot Password?</a>
                                            <a class="btn btn-primary" onclick="login()">Login</a>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a>Need an account? contact an admin to set you up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- adding footer -->
        <?php include("includes/elements/footer.php"); ?>
    </div>
</body>

</html>

<script src="assets/js/scripts.js"></script>

<script>
    function login() {
        var form_data = new FormData();
        var email = $('#inputEmailAddress').val();
        var password = $('#inputPassword').val();

        form_data.append("Email", email);
        form_data.append("Password", password);

        $.ajax({
            type: "post",
            url: `${ApiPath}account&src=AdminLogin`,
            data: form_data,
            contentType: false,
            processData: false,
            cache: false,
            success: function(html) {
                var jsonResult = JSON.parse(html);
                if (!jsonResult.error) {
                    alertify.success('Login Successful');
                    document.cookie = `UserId=${jsonResult.results[0].Id}`;
                    document.cookie = `UserName=${jsonResult.results[0].Names}`;
                    window.location = "index.php";
                } else {
                    alertify.error('Please check Email and Password');
                };
            },
            error: function(x, e) {
                alertify.error('Unknown Error.\n' + x.responseText);
            }
        });
    }
</script>