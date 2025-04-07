<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>Admin List</h4>
                            <div class="add-product">
                                <a href="settings.php?section=add-user&getrole=admin">Add User</a>
                            </div>
                            <table class="table table-bordered" id="userTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone No.</th>
                                    <th>Address</th>
                                    <th>Image</th>
                                    <th>Setting</th>
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

    
    <!-- JavaScript for AJAX -->
    <script>
    $(document).ready(function () {
        function fetchUsers() {
            $.ajax({
                url: "api/admin/get_users.php?getrole=admin",
                type: "GET",
                dataType: "json",
                success: function (response) {
                    let tableBody = $("#userTable tbody");
                    tableBody.empty();

                    if (response.status === "success" && response.data.length > 0) {
                        response.data.forEach(function (user, index) {
                            let profileImage = user.profile_picture ? `<img src="api/uploads/users/${user.profile_picture}" width="50" height="50" alt="Profile">` : "No Image";
                            tableBody.append(`
                                <tr>
                                  <td>${index + 1}</td>  
                                <td>${user.first_name} ${user.last_name}</td>
                                    <td>${user.username}</td>
                                    <td>${user.email}</td>
                                    <td>${user.phone}</td>
                                    <td>${user.address}</td>
                                    <td>${profileImage}</td>
                                     <td>
                                        <button data-toggle="tooltip" title="Edit" class="pd-setting-ed">
                                        <a href="courses.php?section=edit-instructor&id=${user.id}">
                                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                         </a>
                                        </button>
                                        <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        tableBody.html("<tr><td colspan='8'>No users found</td></tr>");
                    }
                },
                error: function (xhr) {
                    console.error("AJAX Error:", xhr.responseText);
                    alert("Failed to fetch users.");
                }
            });
        }

        // Fetch users on page load (No role filter)
        fetchUsers();
    });
</script>
