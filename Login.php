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
                                    <form method="post" action="API/API.php?apicall=users&src=signin">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input name="Email" class="form-control py-4" id="inputEmailAddress" type="email" placeholder="Enter email address" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input name="Password" class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" required />
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.php">Forgot Password?</a>
                                            <button class="btn btn-primary" type="submit">Login</button>
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
</script>