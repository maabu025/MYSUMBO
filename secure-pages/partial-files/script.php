

<script src="dash-assets/js/bootstrap.min.js"></script>

<script src="dash-assets/js/wow.min.js"></script>

<script src="dash-assets/js/jquery-price-slider.js"></script>

<script src="dash-assets/js/jquery.meanmenu.js"></script>

<script src="dash-assets/js/owl.carousel.min.js"></script>

<script src="dash-assets/js/jquery.sticky.js"></script>

<script src="dash-assets/js/jquery.scrollUp.min.js"></script>

<script src="dash-assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="dash-assets/js/scrollbar/mCustomScrollbar-active.js"></script>

<script src="dash-assets/js/metisMenu/metisMenu.min.js"></script>
<script src="dash-assets/js/metisMenu/metisMenu-active.js"></script>

<script src="dash-assets/js/sparkline/jquery.sparkline.min.js"></script>
<script src="dash-assets/js/sparkline/jquery.charts-sparkline.js"></script>

<script src="dash-assets/js/calendar/moment.min.js"></script>
<script src="dash-assets/js/calendar/fullcalendar.min.js"></script>
<script src="dash-assets/js/calendar/fullcalendar-active.js"></script>

<script src="dash-assets/js/flot/jquery.flot.js"></script>
<script src="dash-assets/js/flot/jquery.flot.resize.js"></script>
<script src="dash-assets/js/flot/jquery.flot.pie.js"></script>
<script src="dash-assets/js/flot/jquery.flot.tooltip.min.js"></script>
<script src="dash-assets/js/flot/jquery.flot.orderBars.js"></script>
<script src="dash-assets/js/flot/curvedLines.js"></script>
<script src="dash-assets/js/flot/flot-active.js"></script>
<script src="dash-assets/js/tab.js"></script>
<script src="dash-assets/js/wizard/jquery.steps.js"></script>
    <script src="dash-assets/js/wizard/steps-active.js"></script>
<script src="dash-assets/js/plugins.js"></script>

<script src="dash-assets/js/main.js"></script>

<script>
    document.getElementById("logout").addEventListener("click", function () {
        // ✅ Clear JWT token
        localStorage.removeItem("jwt_token");

        // ✅ Call logout.php to destroy session
        fetch("api/logout.php")
            .then(response => response.json())
            .then(data => {
                console.log("Logout Response:", data.message);
                // ✅ Redirect to login page after logout
                window.location.href = "../../mysumbo/";
            })
            .catch(error => console.error("Logout Error:", error));
    });
</script>