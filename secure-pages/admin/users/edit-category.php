<div class="single-product-tab-area mg-b-30">
    <div class="single-pro-review-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="review-tab-pro-inner">
                        <form id="editCategoryForm" action="javascript:void(0);">
                            <p id="message"></p> <!-- Success/Error message -->

    <input type="hidden" class="form-control" name="getrole" id="getrole">
                            <div class="row">
     <input type="hidden" id="category_id" name="category_id"> <!-- Hidden field for category ID -->
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
                                        <button type="submit" class="btn btn-success">Update Category</button>
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
    let params = new URLSearchParams(window.location.search);
    let categoryId = params.get("id");
    let getRole = params.get("getrole"); // ✅ Get role from URL

    console.log("Get Role:", getRole);

    // If no category ID or role is found in the URL, redirect the user
    if (!categoryId || !getRole) {
        alert("❌ No category selected!");
        window.location.href = "courses.php?section=course-category"; // Redirect
        return;
    }

    // ✅ Store categoryId and role in hidden inputs
    $("#category_id").val(categoryId);
    $("#getrole").val(getRole);

    // ✅ Fetch category details from the API
    fetchCategoryDetails(categoryId, getRole);

    // ✅ Handle form submission
    $("#editCategoryForm").submit(function (event) {
        event.preventDefault();
        updateCategory();
    });
});

// ✅ Function to fetch category details from the database
function fetchCategoryDetails(categoryId, getRole) {
    let token = localStorage.getItem("jwt_token");

    if (!token) {
        alert("❌ Unauthorized! Please log in.");
        window.location.href = "login.php";
        return;
    }

    $.ajax({
        url: `api/admin/get-single-category.php?id=${categoryId}&getrole=${getRole}`,
        type: "GET",
        headers: { "Authorization": "Bearer " + token },
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                $("#category_title").val(response.data.category_name);
                $("#category_description").val(response.data.description);
            } else {
                alert("❌ Error: " + response.message);
                window.location.href = "courses.php?section=course-category";
            }
        },
        error: function (xhr) {
            console.error("❌ AJAX Error:", xhr.responseText);
            alert("❌ Error loading category!");
            window.location.href = "courses.php?section=course-category";
        }
    });
}

// ✅ Function to update the category
function updateCategory() {
    let token = localStorage.getItem("jwt_token");
    let categoryId = $("#category_id").val();
    let getRole = $("#getrole").val(); // ✅ Get role from hidden input
    let categoryTitle = $("#category_title").val().trim();
    let categoryDescription = $("#category_description").val().trim();

    if (!token) {
        alert("❌ Unauthorized! Please log in.");
        window.location.href = "login.php";
        return;
    }

    if (categoryTitle === "" || categoryDescription === "") {
        $("#message").html("<span class='error'>❌ All fields are required.</span>");
        return;
    }

    let categoryData = {
        category_id: categoryId,
        getrole: getRole, // ✅ Include role in request
        category_title: categoryTitle,
        category_description: categoryDescription
    };

    $.ajax({
        url: "api/admin/update-course-category.php",
        type: "POST",
        contentType: "application/json",
        headers: { "Authorization": "Bearer " + token },
        data: JSON.stringify(categoryData),
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                $("#message").html("<span class='success'>✅ Category updated successfully!</span>");
                setTimeout(() => { window.location.href = "courses.php?section=course-category"; }, 1500);
            } else {
                $("#message").html("<span class='error'>❌ " + response.message + "</span>");
            }
        },
        error: function (xhr) {
            console.error("❌ AJAX Error:", xhr.responseText);
            $("#message").html("<span class='error'>❌ Error updating category.</span>");
        }
    });
}

    </script>