<div class="single-product-tab-area mg-b-30">
    <div class="single-pro-review-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="review-tab-pro-inner">
                        <form id="AddCategory" action="javascript:void(0);">
                            <p id="message"></p> <!-- Success/Error message -->
                            <?php
// Check if 'getrole' is set in the URL
if (isset($_GET['getrole'])) {
    $role = $_GET['getrole']; // Get the role value from the URL
    echo "The role is: " . htmlspecialchars($role); // Output the role safely
} else {
    echo "No role provided.";
}
?>
    <input type="hidden" class="form-control" value="<?php echo $role ?>" name="role" id="role">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="review-content-section">
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-user"></i></span>
                                            <input type="text" class="form-control" placeholder="Enter Category Title" 
                                                   name="category_title" id="category_title" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="review-content-section">
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-user"></i></span>
                                            <input type="text" class="form-control" placeholder="Category Description" 
                                                   name="category_description" id="category_description" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center custom-pro-edt-ds">
                                        <button type="submit" class="btn btn-success">Add Category</button>
                                        <a class="btn btn-default" href="courses.php?section=course-category">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
    $("#AddCategory").submit(function (event) {
        event.preventDefault(); // ✅ Stop default form submission

        let getrole = $("#role").val().trim();
        let category_title = $("#category_title").val().trim();
        let category_description = $("#category_description").val().trim();
        let token = localStorage.getItem("jwt_token");

        console.log("✅ JWT Token being sent:", token); // 🔍 Debug Token

        if (!token) {
            alert("❌ Unauthorized! Please log in first.");
            window.location.href = "login.php";
            return;
        }

        if (getrole === "" || category_title === "" || category_description === "") {
            alert("❌ All fields are required.");
            return;
        }

        let categoryData = {
            getrole: getrole,
            category_title: category_title,
            category_description: category_description
        };

        $.ajax({
            url: "api/admin/add-category.php",
            type: "POST",
            contentType: "application/json",
            headers: { "Authorization": "Bearer " + token }, // ✅ Sending JWT Token
            data: JSON.stringify(categoryData),
            dataType: "json"
        })
        .done(function (response) {
            console.log("✅ Server Response:", response);
            if (response.status === "success") {
                alert("✅ Category added successfully!");
                window.location.href = "courses.php?section=course-category";
            } else {
                alert("❌ Error: " + response.message);
            }
        })
        .fail(function (xhr) {
            console.error("❌ AJAX Error:", xhr.responseText);
            alert("❌ Error: " + xhr.responseText);
        });
    });
});
</script>