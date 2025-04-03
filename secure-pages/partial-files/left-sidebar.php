<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/67e587ea37e82d1909b9bfe4/1inc9lrj1';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<?php
// Get user role from session
$user_role = $_SESSION["role"];

// Execute different code based on role
if ($user_role === "admin") {
?>
<nav id="sidebar" class="">
    <div class="sidebar-header">
        <a href="dashboard.php?section=admin-dashboard"><img class="main-logo" src="../dash-assets/img/logo/logo.png" alt="" /></a>
        <strong><img src="../dash-assets/img/logo/logosn.png" alt="" /></strong>
    </div>
    <div class="nalika-profile">
        <div class="profile-dtl">
            <a href="dashboard.php?section=admin-dashboard"><img src="dash-assets/img/notification/4.jpg" alt="" /></a>
            <h2>Lakian <span class="min-dtn">Das</span></h2>
        </div>
        <div class="profile-social-dtl">
            <ul class="dtl-social">
                <li><a href="dashboard.php?section=admin-dashboard"><i class="icon nalika-facebook"></i></a></li>
                <li><a href="dashboard.php?section=admin-dashboard"><i class="icon nalika-twitter"></i></a></li>
                <li><a href="dashboard.php?section=admin-dashboard"><i class="icon nalika-linkedin"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="left-custom-menu-adp-wrap comment-scrollbar">
        <nav class="sidebar-nav left-sidebar-menu-pro">
            <ul class="metismenu" id="menu1">
                <li class="<?php echo ($section == 'courses' ||$section == 'course-category' || $section == 'students' || $section == 'instructors' || $section == 'course-orders') ? 'active' : ''; ?>">
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="icon nalika-home icon-wrap"></i><span class="mini-click-non">Courses</span></a>
                    <ul class="submenu-angle" aria-expanded="false">
                        <li class="<?php echo ($section == 'courses') ? 'active' : ''; ?>"><a href="courses.php?section=courses"><span class="mini-sub-pro">View Courses</span></a></li>
                        <li class="<?php echo ($section == 'course-category') ? 'active' : ''; ?>"><a href="courses.php?section=course-category"><span class="mini-sub-pro">Course Categories</span></a></li>
                        <li class="<?php echo ($section == 'students') ? 'active' : ''; ?>"><a href="courses.php?section=students"><span class="mini-sub-pro">View Students</span></a></li>
                        <li class="<?php echo ($section == 'instructors') ? 'active' : ''; ?>"><a href="courses.php?section=instructors"><span class="mini-sub-pro"></span>View Instructors</a></li>
                    </ul>
                </li>
                <li class="<?php echo ($section == 'products' ||$section == 'product-category' || $section == 'customers' || $section == 'product-orders' || $section == 'delivery' || $section == 'store-settings' || $section == 'product-sales') ? 'active' : ''; ?>">
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="icon nalika-mail icon-wrap"></i> <span class="mini-click-non">Products</span></a>
                    <ul class="submenu-angle" aria-expanded="false">
                    <li class="<?php echo ($section == 'products') ? 'active' : ''; ?>"><a href="products.php?section=products"><span class="mini-sub-pro">View Products</span></a></li>
                    <li class="<?php echo ($section == 'product-category') ? 'active' : ''; ?>"><a href="products.php?section=product-category"><span class="mini-sub-pro">Categories</span></a></li>
                        <li class="<?php echo ($section == 'customers') ? 'active' : ''; ?>"><a href="products.php?section=customers"><span class="mini-sub-pro">View Customers</span></a></li>
                        <li class="<?php echo ($section == 'delivery') ? 'active' : ''; ?>"><a href="products.php?section=delivery"><span class="mini-sub-pro">Shipping & Delivery</span></a></li>
                    </ul>
                </li>
                <li class="<?php echo ($section == 'settings' || $section == 'users' || $section == 'chatbot' ||$section == 'subscription' || $section == 'payments' ||  $section == 'support') ? 'active' : ''; ?>">
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="icon nalika-diamond icon-wrap"></i> <span class="mini-click-non">Settings</span></a>
                    <ul class="submenu-angle" aria-expanded="false">
                        <li class="<?php echo ($section == 'users') ? 'active' : ''; ?>"><a href="settings.php?section=users"><span class="mini-sub-pro">View Users</span></a></li>
                        <li class="<?php echo ($section == 'payments') ? 'active' : ''; ?>"><a href="settings.php?section=orders"><span class="mini-sub-pro">Oders</span></a></li>
                        <li class="<?php echo ($section == 'payments') ? 'active' : ''; ?>"><a href="settings.php?section=payments"><span class="mini-sub-pro">Payments</span></a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="icon nalika-pie-chart icon-wrap"></i> <span class="mini-click-non">Profile</span></a>
                    <ul class="submenu-angle" aria-expanded="false">
                        <li><a href="profile.php?section=edit-profile"><span class="mini-sub-pro">Edit Profile</span></a></li>
                        <li><a href="profile.php?section=password-recovery"><span class="mini-sub-pro">Password Recovery</span></a></li>
                        <li><a href="" id="logout"><span class="mini-sub-pro">Logout</span></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</nav>

<?php
} else if ($user_role === "student" || $user_role === "customer") {

?>
    <nav id="sidebar" class="">
    <div class="sidebar-header">
        <a href="dashboard.php?section=user-dashboard"><img class="main-logo" src="../dash-assets/img/logo/logo.png" alt="" /></a>
        <strong><img src="../dash-assets/img/logo/logosn.png" alt="" /></strong>
    </div>
    <div class="nalika-profile">
        <div class="profile-dtl">
            <a href="dashboard.php?section=user-dashboard"><img src="dash-assets/img/notification/4.jpg" alt="" /></a>
            <h2>Lakian <span class="min-dtn">Das</span></h2>
        </div>
        <div class="profile-social-dtl">
            <ul class="dtl-social">
                <li><a href="dashboard.php?section=user-dashboard"><i class="icon nalika-facebook"></i></a></li>
                <li><a href="dashboard.php?section=user-dashboard"><i class="icon nalika-twitter"></i></a></li>
                <li><a href="dashboard.php?section=user-dashboard"><i class="icon nalika-linkedin"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="left-custom-menu-adp-wrap comment-scrollbar">
        <nav class="sidebar-nav left-sidebar-menu-pro">
            <ul class="metismenu" id="menu1">
                <li class="<?php echo ($section == 'courses' ||$section == 'course-category' || $section == 'students' || $section == 'instructors' || $section == 'course-orders') ? 'active' : ''; ?>">
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="icon nalika-home icon-wrap"></i><span class="mini-click-non">Courses</span></a>
                    <ul class="submenu-angle" aria-expanded="false">
                    <li class="<?php echo ($section == 'buy-course') ? 'active' : ''; ?>"><a href="courses.php?section=buy-course"><span class="mini-sub-pro">Buy Courses</span></a></li>
                        <li class="<?php echo ($section == 'courses') ? 'active' : ''; ?>"><a href="courses.php?section=mycourses"><span class="mini-sub-pro">my Courses</span></a></li>
                    </ul>
                </li>
                <li class="<?php echo ($section == 'products' ||$section == 'product-category' || $section == 'customers' || $section == 'product-orders' || $section == 'delivery' || $section == 'store-settings' || $section == 'product-sales') ? 'active' : ''; ?>">
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="icon nalika-mail icon-wrap"></i> <span class="mini-click-non">Products</span></a>
                    <ul class="submenu-angle" aria-expanded="false">
                    <li class="<?php echo ($section == 'buy-product') ? 'active' : ''; ?>"><a href="products.php?section=buy-product"><span class="mini-sub-pro">Buy Products</span></a></li>
                    <li class="<?php echo ($section == 'myproducts') ? 'active' : ''; ?>"><a href="products.php?section=myproducts"><span class="mini-sub-pro">my Products</span></a></li>
                    </ul>
                </li>
                <li class="<?php echo ($section == 'orders') ? 'active' : ''; ?>">
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="icon nalika-pie-chart icon-wrap"></i> <span class="mini-click-non">Profile</span></a>
                    <ul class="submenu-angle" aria-expanded="false">
                    <li class="<?php echo ($section == 'orders') ? 'active' : ''; ?>"><a href="settings.php?section=orders"><span class="mini-sub-pro">My Oders</span></a></li>
                    <li><a href="profile.php?section=edit-profile"><span class="mini-sub-pro">Edit Profile</span></a></li>
                    <li><a href="profile.php?section=password-recovery"><span class="mini-sub-pro">Password Recovery</span></a></li>
                        <li><a href="" id="logout"><span class="mini-sub-pro">Logout</span></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</nav>
<?php
}
?>