<!DOCTYPE html>
<html lang="en">
    <head>
    <?php require 'partial-files/head.html'; ?>
    </head>
    <body>
        <div class="header-container">
        <?php require 'partial-files/menu.html'; ?>
<section class="hero">
            <h1>Empowering Farmers with Smart Agriculture Solutions!</h1>
            <p>Learn sustainable farming, get expert support, and connect with buyers—all in one place.</p>
            <button>Sign Up Now</button>
        </section>
        
        <section class="features">
            <div class="feature">
                <h2>🧑‍🌾 Farmer Training</h2>
                <p>Access expert courses on irrigation, post-harvest management, and sustainable farming.</p>
            </div>
            <div class="feature">
                <h2>🤖 AI Chatbot</h2>
                <p>Get real-time farming advice and solutions from our AI-powered assistant.</p>
            </div>
            <div class="feature">
                <h2>🛒 Online Marketplace</h2>
                <p>Buy and sell agricultural products effortlessly.</p>
            </div>
        </section>
<div>
    <h1 class="course-heading">FEATURED COURSES</h1>
    <div class="row" id="courseContainer">
        <!-- Courses will be loaded here dynamically -->
    </div>
<button class="course-btn view-course"><a href="courses.php">Browse All Courses</a></button>
</div>
<section class="testimonials">
            <h2>What Farmers Say</h2>
            <p>"Thanks to SUMBO APP, I improved my harvest by 30% and found new buyers!" – Mr. Boamah, Ghana</p>
        </section>
        <?php require 'partial-files/footer.html'; ?>

        
<!-- ✅ AJAX Script -->
<script>
$(document).ready(function () {
    function fetchCourses() {
        $.ajax({
            url: "api/get_courses.php", // ✅ API path
            type: "GET",
            dataType: "json",
            success: function (response) {
                let courseContainer = $("#courseContainer");
                courseContainer.empty(); // ✅ Clear previous content

                if (response.status === "success" && response.data.length > 0) {
                    response.data.forEach(function (course) {
                        let courseImage = course.course_image_url ? `../secure_pages/api/uploads/courses/${course.course_image_url}` : "../secure_pages/dash-assets/img/cropper/1.jpg";
                        let profileImage = "../secure_pages/dash-assets/img/contact/2.jpg"; // Placeholder profile image

                        let courseCard = `
            <a href="../secure_pages/courses.php?section=course-detail&course_id=${course.course_id}">
                <div class="col-3">
                <div class="course-image"> 
    <img src="${courseImage}" alt="Course Image">
    <h3 class="course-title">${course.course_title}</h3>
</div>
            </a>
                <div class="row">
        <div class="col-4">
        <h3 class="course-price">$${course.course_price}</h3>
        </div>
        <div class="col-4">
            <button class="course-btn"><a href="../secure_pages/courses.php?section=course-detail&course_id=${course.course_id}">Buy Now</a></button>  
        </div>
        <div class="col-4">
            <button class="course-btn"><a href="../secure_pages/courses.php?section=course-detail&course_id=${course.course_id}">Add to cart</a></button>
        </div>
                </div>
            </div>
                        `;
                        courseContainer.append(courseCard);
                    });
                } else {
                    courseContainer.html("<div class='col-12 text-center'><h3>No courses found.</h3></div>");
                }
            },
            error: function (xhr) {
                console.error("AJAX Error:", xhr.responseText);
                alert("❌ Error fetching courses.");
            }
        });
    }

    fetchCourses(); // ✅ Load courses when the page loads
});
</script>
    </body>

</html>