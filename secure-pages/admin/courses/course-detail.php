<!-- Course Details Section -->
<div class="single-product-tab-area mg-t-0 mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-product-pr">
                    <div class="row">
                        <!-- Course Image -->
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <div class="tab-content">
                                <div class="product-tab-list tab-pane fade active in" id="course-image">
                                    <img id="courseImage" src="dash-assets/img/product/bg-1.jpg" alt="Course Image" />
                                </div>
                            </div>
                        </div>

                        <!-- Course Details -->
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                            <div class="single-product-details res-pro-tb">
                                <h1 id="courseTitle">Course Title</h1>
                                <span class="single-pro-star">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                                <div class="single-pro-price">
                                    <span class="single-regular" id="coursePrice">$0.00</span>
                                </div>
                                <div class="single-pro-cn">
                                    <h3>Instructor</h3>
                                    <p id="instructorName">Instructor Name</p>
                                    <h3>Category</h3>
                                    <p id="courseCategory">Category Name</p>
                                    <h3>Overview</h3>
                                    <p id="courseDescription">Loading...</p>
                                </div>
                                <div class="single-pro-button">
                                    <div class="pro-button">
                                        <a href="" id="enrollNowBtn">PAY NOW</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-social-area">
                                    <h3>Share this on</h3>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-feed"></i></a>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    function fetchCourseDetails() {
        const urlParams = new URLSearchParams(window.location.search);
        const courseId = urlParams.get("course_id");

        if (!courseId) {
            alert("❌ No course ID provided.");
            return;
        }

        $.ajax({
            url: "api/admin/get_course_details.php?id=" + courseId, // ✅ API call
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    let course = response.data;

                    $("#courseImage").attr("src", course.course_image_url ? "api/uploads/courses/" + course.course_image_url : "dash-assets/img/product/bg-1.jpg");
                    $("#courseTitle").text(course.course_title);
                    $("#coursePrice").text("$" + course.course_price);
                    $("#instructorName").text(course.first_name + " " + course.last_name);
                    $("#courseCategory").text(course.category_name);
                    $("#courseDescription").text(course.course_description);
                    $("#enrollNowBtn").attr("href", "api/admin/process_checkout.php?id=" + course.course_id + "&type=course&title=" + course.course_title + "&price=" + course.course_price + "&image=" + encodeURIComponent(course.course_image_url));
                } else {
                    $(".single-product-tab-area").html("<h2 class='text-center'>❌ Course not found.</h2>");
                }
            },
            error: function (xhr) {
                console.error("AJAX Error:", xhr.responseText);
                alert("❌ Error fetching course details.");
            }
        });
    }

    fetchCourseDetails(); // ✅ Load course details when the page loads
});
</script>