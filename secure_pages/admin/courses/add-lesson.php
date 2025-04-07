<?php
include "api/config.php";

$courseid = $_GET['id'] ?? null;

if (!$courseid) {
    echo "<script>alert('❌ Course ID Missing');</script>";
    exit;
}

// Fetch the course title based on course_id
$stmt = $pdo->prepare("SELECT course_title FROM courses WHERE course_id = ?");
$stmt->bindParam(1, $courseid, PDO::PARAM_INT);
$stmt->execute();
$course = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch single row

$coursename = $course['course_title'] ?? "Course Not Found"; // Get title safely

//echo $coursename;
?>


<div class="container mt-5" style="background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
        <h2 class="text-center">Course: <?php echo $coursename; ?></h2>
        <form id="lessonForm">
            <!-- Course Selection -->
            <div class="mb-3">
                <label for="course_id" class="form-label">Course</label>
                <input type="hidden" class="form-control" value="<?php echo $courseid; ?>" id="course_id" name="course_id" required>
                <input type="text" class="form-control"  value="<?php echo $coursename; ?>" id="course_title" name="course_title" required>
            </div>

            <!-- Lesson Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Lesson Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <!-- Lesson Content -->
            <div class="mb-3">
                <label for="content" class="form-label">Lesson Content</label>
                <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
            </div>

            <!-- Video URL -->
            <div class="mb-3">
                <label for="video_url" class="form-label">Video URL (Required)</label>
                <input type="url" class="form-control" id="video_url" name="video_url">
            </div>

            <!-- Submit Button -->
            <div class="text-center custom-pro-edt-ds">
                <br>
            <button type="submit" class="btn btn-primary">Add Lesson</button>
            </div>
        </form>

        <div id="responseMessage" class="mt-3"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#lessonForm").submit(function (event) {
                event.preventDefault();

                $.ajax({
                    url: "api/admin/process-add-lesson.php",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            $("#responseMessage").html('<div class="alert alert-success">' + response.message + '</div>');
                            $("#lessonForm")[0].reset(); // Clear form
                        } else {
                            $("#responseMessage").html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function () {
                        $("#responseMessage").html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                    }
                });
            });
        });
    </script>