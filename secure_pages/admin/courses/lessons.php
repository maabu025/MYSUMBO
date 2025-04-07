<div class="container mt-5">
        <h2 class="text-center">📚 Course Lessons</h2>
        <div class="add-product">
                                <a href="courses.php?section=add-lesson">Add Lesson</a>
                            </div>
        <table class="table table-bordered text-white">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Lesson Title</th>
                    <th>Content</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="lessonsTableBody">
                <tr>
                    <td colspan="4" class="text-center">Loading lessons...</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- 🎥 Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Lesson Video</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <iframe id="videoPlayer" width="100%" height="400" src="" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>



            <script>
$(document).ready(function () {
    let urlParams = new URLSearchParams(window.location.search);
    let course_id = urlParams.get("id");

    if (!course_id) {
        $("#lessonsTableBody").html("<tr><td colspan='4' class='text-center text-danger'>❌ Course ID Missing</td></tr>");
        return;
    }

    $.ajax({
        url: "api/admin/get_lesson.php?id=" + course_id,
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                let lessons = response.data.lessons;
                let tableContent = "";

                if (lessons.length > 0) {
                    lessons.forEach((lesson, index) => {
                        tableContent += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${lesson.title}</td>
                                <td>${lesson.content.substring(0, 50)}...</td>
                                <td>
                                    <button class="btn btn-primary watch-video" data-video="${lesson.video_url}" data-title="${lesson.title}">
                                        🎥 Watch Video
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    tableContent = `<tr><td colspan='4' class='text-center'>📭 No lessons found.</td></tr>`;
                }

                $("#lessonsTableBody").html(tableContent);
            } else {
                $("#lessonsTableBody").html(`<tr><td colspan='4' class='text-center text-danger'>❌ ${response.message}</td></tr>`);
            }
        },
        error: function () {
            $("#lessonsTableBody").html("<tr><td colspan='4' class='text-center text-danger'>❌ Error loading lessons.</td></tr>");
        }
    });

    // 🎥 Open Video in Modal
    $(document).on("click", ".watch-video", function () {
        let videoUrl = $(this).data("video");
        let lessonTitle = $(this).data("title");

        if (!videoUrl) {
            alert("❌ No video available for this lesson.");
            return;
        }

        $("#videoModalLabel").text(lessonTitle);
        $("#videoPlayer").attr("src", videoUrl);
        $("#videoModal").modal("show");
    });

    // 🛑 Stop Video when Modal Closes
    $("#videoModal").on("hidden.bs.modal", function () {
        $("#videoPlayer").attr("src", "");
    });
});

</script>