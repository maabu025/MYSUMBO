
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>Course Category</h4>
                            <div class="add-product">
                                <a href="settings.php?section=add-category&getrole=course">Add Course Category</a>
                            </div>
                        
                            <table id="categoryTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="align-items: center;">Image</th>
                                    <th style="align-items: center;">Category Name</th>
                                    <th style="align-items: center;">Category Description</th>
                                    <th style="align-items: center;">Option</th>
                                </tr>
                                </thead>
                                <tbody>
            <tr><td colspan="8">Loading users...</td></tr>
        </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
<script>
    $(document).ready(function () {
        fetchCategories();
    });

    function fetchCategories() {
        let token = localStorage.getItem("jwt_token"); // ✅ Get stored JWT token

        if (!token) {
            alert("❌ Unauthorized! Please log in first.");
            window.location.href = "login.php"; // Redirect to login page if token is missing
            return;
        }

        $.ajax({
            url: "api/admin/get-categories.php?getrole=course",
            type: "GET",
            dataType: "json",
            headers: { "Authorization": "Bearer " + token }, // ✅ Send JWT in headers
            success: function (response) {
                console.log("✅ Server Response:", response);

                if (response.status === "success") {
                    let categories = response.data;
                    let tableBody = "";

                    categories.forEach(category => {
                        tableBody += `<tr>
                            <td>${category.course_category_id}</td>
                            <td>${category.category_name}</td>
                            <td>${category.description}</td>
                            <td>
                                        <button data-toggle="tooltip" title="Edit" class="pd-setting-ed">
                                        <a href="settings.php?section=edit-category&getrole=product&id=${category.course_category_id}">
                                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                         </a>
                                        </button>
                                        <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </td>
                        </tr>`;
                    });

                    $("#categoryTable tbody").html(tableBody);
                    $("#categoryTable").DataTable(); // ✅ Apply DataTable for better UI
                } else {

                    tableBody.html("<tr><td colspan='8'>No users found</td></tr>");
                    alert("❌ Error: " + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("❌ AJAX Error:", xhr.responseText);
                alert("❌ Error fetching categories: " + xhr.responseText);
                window.location.href = "login.php"; // Redirect to login if unauthorized
            }
        });
    }
</script>
