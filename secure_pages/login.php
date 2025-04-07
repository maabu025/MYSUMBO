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
                    <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
            <div class="col-md-4 col-md-4 col-sm-4 col-xs-12">
                <div class="text-center m-b-md custom-login" style="color: #fff;">
                    <h3>SUMBO APP LOGIN</h3>
                    <p id="message"></p> <!-- Login message -->
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="#" id="loginForm">
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" placeholder="example@gmail.com" title="Please enter you username" required="" value="" name="email" id="email" class="form-control">
                                <span class="help-block small">Your unique username to app</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
                                <span class="help-block small">Yur strong password</span>
                            </div>
                            <div class="checkbox login-checkbox">
                                <label>
										<input type="checkbox" class="i-checks"> Remember me </label>
                                <p class="help-block small">(if this is a private computer)</p>
                            </div>
                            <button class="btn btn-success btn-block loginbtn">Login</button>
                            <a class="btn btn-default btn-block" href="register.php">Register</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
        </div>
    </div>
    <br style="display: grid; grid-template-rows: auto 1fr auto; min-height: 100vh;">
    <div class="row" style="text-align: center;">
        <?php require 'partial-files/footer.php'; ?>
        </div>
        <?php require 'partial-files/script.php'; ?>
        <script>
$(document).ready(function () {
    $("#loginForm").submit(function (event) {
        event.preventDefault(); // Prevent default form submission

        let email = $("#email").val().trim();
        let password = $("#password").val().trim();

        // Basic validation
        if (email === "" || password === "") {
            $("#message").html("<span style='color: red;'>All fields are required.</span>");
            return;
        }

        $.ajax({
            url: "api/admin/login-admin.php", // ✅ API path
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify({ email: email, password: password }),
            dataType: "json",
            success: function (response) {
                console.log("Server Response:", response); // Log response for debugging

                if (response.status === "success") {
                    $("#message").html("<span style='color: green;'>Login successful! Redirecting...</span>");

                    // ✅ Store token & role in localStorage
                    localStorage.setItem("jwt_token", response.token);
                    localStorage.setItem("user_role", response.role);

                    // ✅ Redirect based on user role
                    setTimeout(() => {
                        if (response.role === "admin") {
                            window.location.href = "dashboard.php?section=admin-dashboard";
                        } else if (response.role === "trainer") {
                            window.location.href = "dashboard.php?section=instructor-dashboard";
                        } else if (response.role === "student" || response.role === "customer") {
                            window.location.href = "dashboard.php?section=user-dashboard";
                        } else {
                            window.location.href = "dashboard.php?section=user-dashboard"; // Fallback page
                        }
                    }, 1000); // Delay of 1 second
                } else {
                    console.error("Login Error:", response.message);
                    $("#message").html("<span style='color: red;'>" + response.message + "</span>");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                console.error("Full Response:", xhr);
                console.error("Response Text:", xhr.responseText); // Log full response text
                $("#message").html("<span style='color: red;'>Login failed. Check console for details.</span>");
            }
        });
    });
});
</script>



</body>
</html>