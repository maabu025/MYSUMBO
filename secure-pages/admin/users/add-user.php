
<div class="single-product-tab-area mg-b-30">
            <!-- Single pro tab review Start-->
            <div class="single-pro-review-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="review-tab-pro-inner">
<!-- Success/Error Message -->
<div id="message"></div>
                            <form action="javascript:void(0);" id="AddInstructor">
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
        <!-- Left Column -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="review-content-section">
                <div class="input-group mg-b-pro-edt">
                    <span class="input-group-addon"><i class="icon nalika-user"></i></span>
                    <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" required>
                </div>
                <div class="input-group mg-b-pro-edt">
                    <span class="input-group-addon"><i class="icon nalika-user"></i></span>
                    <input type="email" class="form-control" placeholder="Email Address" name="email" id="email" required>
                </div>
                <div class="input-group mg-b-pro-edt">
                    <span class="input-group-addon"><i class="icon nalika-new-file"></i></span>
                    <input type="text" class="form-control" placeholder="Address" name="address" id="address" required>
                </div>
                <div class="input-group mg-b-pro-edt">
                    <span class="input-group-addon"><i class="icon nalika-new-file"></i></span>
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username" required>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="review-content-section">
                <div class="input-group mg-b-pro-edt">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" required>
                </div>
                <div class="input-group mg-b-pro-edt">
                    <span class="input-group-addon"><i class="icon nalika-new-file"></i></span>
                    <input type="text" class="form-control" placeholder="Phone Number" name="phone" id="phone" required>
                </div>
                <div class="input-group mg-b-pro-edt">
                    <span class="input-group-addon"><i class="icon nalika-new-file"></i></span>
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                </div>
                <div class="input-group mg-b-pro-edt">
                    <span class="input-group-addon"><i class="icon nalika-like"></i></span>
                    <input type="file" class="form-control" name="upload_image" id="upload_image">
                </div>
            </div>
        </div>
    </div>

    <!-- Buttons -->
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center custom-pro-edt-ds">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="reset" class="btn btn-danger">Discard</button>
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
$(document).ready(function() {
    $("#AddInstructor").submit(function(event) {
        event.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "api/admin/add-user.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json", // Ensure JSON response
            success: function(response) {
                alert(response.message); // Show success message
                console.log(response);

                if (response.status === "success") {
                    window.location.href = "courses.php?section=users"; // Redirect on success
                }
            },
            error: function(xhr) {
                console.error("AJAX Error:", xhr.responseText);
                alert("An error occurred: " + xhr.responseText); // Show error message
            }
        });
    });
});

</script>