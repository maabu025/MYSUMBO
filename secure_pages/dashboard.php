<script src="dash-assets/js/vendor/modernizr-2.8.3.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let token = localStorage.getItem("jwt_token");

        if (!token) {
            // 🚀 Redirect to login page if no token is found
            window.location.href = "login.php";
        }
    });
</script>
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
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
    <div class="left-sidebar-pro">
    <?php require 'partial-files/left-sidebar.php'; ?>
    </div>
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
    <div class="container-fluid">
    <?php require 'partial-files/header-logo.php'; ?>
        </div>
        <div class="header-advance-area">
            <?php require 'partial-files/top-header.php'; ?>
            </div>
            <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
            <?php require 'partial-files/mobile-menu.php'; ?>
            </div>
            <!-- Mobile Menu end -->
            <div class="breadcome-area">
            <?php require 'partial-files/breadcome.php'; ?>
        </div>
        <?php

// Define a list of allowed sections (whitelist)
$allowed_sections = [
    "admin-dashboard",
    "user-dashboard",

];

// Check if $section is in the allowed list
if (in_array($section, $allowed_sections)) {
    $file_path = 'admin/users/' . $section . '.php';

    if (file_exists($file_path)) {
        require $file_path;
    } else {
        echo "Error: File not found!";
    }
} else {
    echo "Error: Invalid section!";
}
?>
</div>

        <div class="footer-copyright-area">
        <?php require 'partial-files/footer.php'; ?>
    </div>
    </div>
	<?php require 'partial-files/script.php'; ?>
</body>

</html>