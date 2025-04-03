<div class="single-product-tab-area mg-b-30">
            <!-- Single pro tab review Start-->
            <div class="single-pro-review-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="review-tab-pro-inner">
                            <form action="javascript:void(0);" id="AddProduct">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input type="text" class="form-control" placeholder="Enter Product Name" id="product_name" name="product_name" required> 
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-edit" aria-hidden="true"></i></span>
                                                        <input type="text" class="form-control" placeholder="Product description" id="product_description" name="product_description" required>    
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-edit" aria-hidden="true"></i></span>
                                                        <select class="form-control pro-edt-select form-control-primary" id="category_id" name="category_id" required>
                                                        <option value="">Select Category</option>
														</select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                                                        <input type="text" class="form-control" placeholder="Enter Price" id="product_price" name="product_price" required>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-favorites-button" aria-hidden="true"></i></span>
                                                        <input type="text" class="form-control" placeholder="Enter stock quantity" id="stock_quantity" name="stock_quantity" required>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                    <span class="input-group-addon"><i class="icon nalika-new-file"></i></span>
                    <input type="file" class="form-control" name="product_image" id="product_image">
                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <  <div class="text-center custom-pro-edt-ds">
                                        <button type="submit" class="btn btn-success">Add Course</button>
                                        <a class="btn btn-default" href="courses.php?section=course-category">Cancel</a>
                                    </div>
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
            // Fetch Categories
            function fetchCategories() {
                $.ajax({
                    url: "api/admin/get-categories.php?getrole=product",
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            response.data.forEach(function (category) {
                                $("#category_id").append(`<option value="${category.product_category_id}">${category.category_name}</option>`);
                            });
                        } else {
                            alert("Error: " + response.message);
                        }
                    },
                    error: function (xhr) {
                        console.error("Error fetching categories:", xhr.responseText);
                    }
                });
            }

            fetchCategories();

            // Handle Form Submission
            $("#AddProduct").submit(function (event) {
                event.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: "api/admin/add-product.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status === "success") {
                            $("#message").html("<span style='color: green;'>✅ Product added successfully!</span>");
                            setTimeout(() => {
                                window.location.href = "products.php?section=products";
                            }, 2000);
                        } else {
                            $("#message").html("<span style='color: red;'>❌ " + response.message + "</span>");
                        }
                    },
                    error: function (xhr) {
                        console.error("Error:", xhr.responseText);
                        $("#message").html("<span style='color: red;'>❌ Error adding course.</span>");
                    }
                });
            });
        });
    </script>