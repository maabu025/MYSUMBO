<!DOCTYPE html>
<html lang="en">
    <head>
    <?php require 'partial-files/head.html'; ?>
    </head>
    <body>
        
    <?php require 'partial-files/menu.html'; ?>
      <!-- ✅ Search Bar -->
<form class="search-bar">
    <input type="text" id="search-input" placeholder="search...."/>
    <button type="submit">🔍</button>
</form>

<!-- ✅ Header Image -->
<div class="slider-container">
    <div class="header-container-courses">
        <img src="../assets/img/online.JPG" height="100%" width="100%">
        <h1>Learn a new <strong>agricultural</strong> skill today!</h1>
    </div>
</div>

<!-- ✅ Your HTML -->
<div>
    <h1 class="course-heading">COURSES</h1>
    <div class="row" id="courseContainer">
        <!-- Courses will be loaded here dynamically -->
    </div>
</div>

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
