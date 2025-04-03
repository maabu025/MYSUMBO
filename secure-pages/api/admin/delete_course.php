<?php
require '../config.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $course_id = $_GET["id"]; // ✅ Fixed the variable name

    try {
        // ✅ Check if lessons exist for this course
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM lessons WHERE course_id = ?");
        $stmt->execute([$course_id]);
        $lessonCount = $stmt->fetchColumn();

        if ($lessonCount > 0) {
            // ✅ Delete lessons first if they exist
            $stmt = $pdo->prepare("DELETE FROM lessons WHERE course_id = ?");
            $stmt->execute([$course_id]);
        }

        // ✅ Now delete the course
        $stmt = $pdo->prepare("DELETE FROM courses WHERE course_id = ?");
        $stmt->execute([$course_id]);

        // ✅ Redirect after deletion
        header("Location: ../../courses.php?section=courses&message=Course+deleted+successfully");
        exit;
    } catch (PDOException $e) {
        // ✅ Redirect with an error message if deletion fails
        header("Location: ../../courses.php?section=courses&error=Failed+to+delete+course");
        exit;
    }
} else {
    // ✅ Redirect if no valid course ID is provided
    header("Location: ../../courses.php?section=courses&error=Invalid+request");
    exit;
}
?>
