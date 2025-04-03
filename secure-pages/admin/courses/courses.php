<?php
require 'api/config.php'; // Include database connection

// Fetch courses
$stmt = $pdo->query("SELECT * FROM courses");
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if (isset($_GET['message'])): ?>
    <p style="color: green;"><?php echo htmlspecialchars($_GET['message']); ?></p>
<?php endif; ?>
<?php if (isset($_GET['error'])): ?>
    <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
<?php endif; ?>


<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>Course List</h4>
                            <div class="add-product">
                                <a href="courses.php?section=add-course">Add Course</a>
                            </div>
                            <table class="table table-bordered" id="courseTable">
                            <thead class="table-dark">
                                <tr>
                                <th style="align-items: center;">No.</th>
                                    <th style="align-items: center;">Image</th>
                                    <th style="align-items: center;">Course Name</th>
                                    <th style="align-items: center;">Category</th>
                                    <th style="align-items: center;">Description</th>
                                    <th style="align-items: center;">Price</th>
                                    <th style="align-items: center;">Instructor</th>
                                    <th style="align-items: center;">Option</th>
                                </tr>
                            </thead>
        <tbody>
            <!-- Product will be loaded here -->
        </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <script>
$(document).ready(function () {
    function fetchCourses() {
        $.ajax({
            url: "api/admin/get_courses.php", // Adjust the path if needed
            type: "GET",
            dataType: "json",
            success: function (response) {
                let tableBody = $("#courseTable tbody");
                tableBody.empty();

                if (response.status === "success" && response.data.length > 0) {
                    response.data.forEach(function (course, index) {
                        let courseImage = course.course_image_url 
                            ? `<img src="api/uploads/courses/${course.course_image_url}" alt="Product">`
                            : "No Image";

                        tableBody.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${courseImage}</td>
                                <td>${course.course_title}</td>
                                <td>${course.category_name}</td>
                                <td>${course.course_description}</td>
                                <td>${course.course_price}</td>
                                <td>${course.first_name} ${course.last_name}</td>
                                 <td>
                                        <button data-toggle="tooltip" title="Edit" class="pd-setting-ed">
                                        <a href="courses.php?section=edit-course&id=${course.course_id}">
                                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                         </a>
                                        </button>
                                          <button data-toggle="tooltip" title="Lessons" class="pd-setting-ed">
                                        <a href="courses.php?section=add-lesson&id=${course.course_id}">
                                          <i class="fa fa-plus" aria-hidden="true"></i>
                                         </a>
                                         <button data-toggle="tooltip" title="Lessons" class="pd-setting-ed">
                                        <a href="courses.php?section=lessons&id=${course.course_id}">
                                          <i class="fa fa-eye" aria-hidden="true"></i>
                                         </a>
                                        </button>
                                        <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><a href="api/admin/delete_course.php?id=${course.course_id}">
                                          <i class="fa fa-trash-o" aria-hidden="true"></i>
                                         </a>
                                        </button>
                                        
                                    </td>
                            </tr>
                        `);
                    });
                } else {
                    tableBody.html("<tr><td colspan='6' class='text-center'>No products found</td></tr>");
                }
            },
            error: function (xhr) {
                console.error("AJAX Error:", xhr.responseText);
                alert("Failed to fetch products.");
            }
        });
    }

    fetchCourses(); // Fetch products on page load
});
</script>