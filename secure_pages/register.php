<?php
// Enable all error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'php_errors.log'); // Log file
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
<?php require 'partial-files/head.php'; ?>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="color-line"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="back-link back-backend">
                    <a href="login.php" class="btn btn-primary">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
            <div class="col-md-6 col-md-6 col-sm-6 col-xs-12">
                <div class="text-center custom-login" style="color: #fff;">
                    <h3>Instructor Registration</h3>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="#" id="loginForm">
                            <div class="row">
                            <div class="form-group col-lg-6">
                                    <label>First Name</label>
                                    <input class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Last Name</label>
                                    <input class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Phone No.</label>
                                    <input class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Email Address</label>
                                    <input class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Email Address</label>
                                    <input class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Username</label>
                                    <input class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Repeat Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Profile Picture</label>
                                    <input class="form-control">
                                </div>
                                <div class="checkbox col-lg-12">
                                    <input type="checkbox" class="i-checks" checked> Sigh up for our newsletter
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-success loginbtn">Register</button>
                                <button class="btn btn-default">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
        </div>
  <div class="footer-copyright-area">
        <?php require 'partial-files/footer.php'; ?>
    </div>
    </div>

</body>

<?php require 'partial-files/script.php'; ?>
 <script>
        $(document).ready(function () {
            $("#registerForm").submit(function (event) {
                event.preventDefault();

                let userData = {
                    username: $("#username").val(),
                    email: $("#email").val(),
                    password: $("#password").val(),
                    role: $("#role").val()
                };

                $.ajax({
    url: "../api/admin/register-admin.php",
    type: "POST",
    contentType: "application/json",
    data: JSON.stringify(userData),
    dataType: "json",
    success: function (response) {
        console.log("Server Response:", response);
        if (response.status === "success") {
            $("#message").php("<span style='color: green;'>Registered successfully!</span>");
            setTimeout(() => { window.location.href = "login.php"; }, 1500);
        } else {
            $("#message").php("<span style='color: red;'>" + response.message + "</span>");
        }
    },
    error: function (xhr, status, error) {
        console.error("AJAX Error:", status, error, xhr.responseText);
        $("#message").php("<span style='color: red;'>Error: " + xhr.responseText + "</span>");
    }
});
            });
        });
    </script>
</html>