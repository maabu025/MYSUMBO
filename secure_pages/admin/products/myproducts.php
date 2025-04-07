<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>Course List</h4>
                            <div class="add-product">
                                <a href="products.php?section=add-product">Add Product</a>
                            </div>
                            <table class="table table-bordered" id="productTable">
                            <thead class="table-dark">
                                <tr>
                                <th style="align-items: center;">No.</th>
                                    <th style="align-items: center;">Image</th>
                                    <th style="align-items: center;">Product Name</th>
                                    <th style="align-items: center;">Category</th>
                                    <th style="align-items: center;">Description</th>
                                    <th style="align-items: center;">Price</th>
                                    <th style="align-items: center;">Stock</th>
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
    function fetchProducts() {
        $.ajax({
            url: "api/admin/get_myproducts.php", // Adjust the path if needed
            type: "GET",
            dataType: "json",
            success: function (response) {
                let tableBody = $("#productTable tbody");
                tableBody.empty();

                if (response.status === "success" && response.data.length > 0) {
                    response.data.forEach(function (product, index) {
                        let productImage = product.image_url 
                            ? `<img src="uploads/products/${product.image_url}" alt="Product">`
                            : "No Image";

                        tableBody.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${productImage}</td>
                                <td>${product.name}</td>
                                <td>${product.category_name}</td>
                                <td>${product.description}</td>
                                <td>$${product.price}</td>
                                <td>${product.stock_quantity}</td>
                                 <td>
                                        <button data-toggle="tooltip" title="Edit" class="pd-setting-ed">
                                        <a href="products.php?section=product-detail&product_id=${product.product_id}">
                                          <i class="fa fa-eye" aria-hidden="true"></i>
                                         </a>
                                        </button>
                                        <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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

    fetchProducts(); // Fetch products on page load
});
</script>