<div class="blog-area mg-tb-15">
            <div class="container-fluid">
                <div class="row" id="courseContainer">
                    <!-- Courses will be displayed here -->
                </div>
            </div>
        </div>

        <script>
$(document).ready(function () {
    function fetchCourses() {
        $.ajax({
            url: "api/admin/get_courses.php", // ✅ API path
            type: "GET",
            dataType: "json",
            success: function (response) {
                let courseContainer = $("#courseContainer");
                courseContainer.empty(); // Clear previous content

                if (response.status === "success" && response.data.length > 0) {
                    response.data.forEach(function (course) {
                        let courseImage = course.course_image_url ? `api/uploads/courses/${course.course_image_url}` : "dash-assets/img/cropper/1.jpg";
                        let profileImage = "dash-assets/img/contact/2.jpg"; // Placeholder profile image

                        let courseCard = `
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="hpanel blog-box mg-t-30 responsive-mg-b-0">
                                    <div class="panel-heading custom-blog-hd">
                                        <div class="media clearfix">
                                            <a class="pull-left">
                                                <img class="img-circle" src="${profileImage}" alt="profile-picture">
                                            </a>
                                            <div class="media-body blog-std">
                                                <p>Created by: <span class="font-bold">${course.first_name} ${course.last_name}</span></p>
                                                <p class="text-muted">${new Date().toLocaleDateString()}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body blog-pra">
                                        <div class="blog-img">
                                            <img src="${courseImage}" alt="Course Image" style="width:100%; height:180px;">
                                            <a href="course_details.php?id=${course.course_id}">
                                                <h4>${course.course_title}</h4>
                                            </a>
                                        </div>
                                        <p>${course.course_description.substring(0, 100)}...</p>
                                    </div>
                                    <div class="panel-footer">
                                        <span class="pull-right">
                                            <a class="btn btn-default" href="courses.php?section=course-detail&course_id=${course.course_id}">ENROLL NOW</a>
                                        </span>
                                        <a class="btn btn-default">$${course.course_price}</a>
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
