<div class="blog-area mg-tb-15">
            <div class="container-fluid">
                <div class="row" id="productContainer">
                    <!-- Products will be displayed here -->
                </div>
            </div>
        </div>

        <script>
$(document).ready(function () {
    function fetchProducts() {
        $.ajax({
            url: "api/admin/get_products.php", // ✅ API path
            type: "GET",
            dataType: "json",
            success: function (response) {
                let productContainer = $("#productContainer");
                productContainer.empty(); // Clear previous content

                if (response.status === "success" && response.data.length > 0) {
                    response.data.forEach(function (product) {
                        let productImage = product.product_image_url ? `uploads/products/${product.image_url}` : "dash-assets/img/cropper/1.jpg";

                        let productCard = `
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="hpanel blog-box mg-t-30 responsive-mg-b-0">
                                    <div class="panel-body blog-pra">
                                        <div class="blog-img">
                                            <img src="${productImage}" alt="Product Image" style="width:100%; height:180px;">
                                            <a href="product_details.php?id=${product.product_id}">
                                                <h4>${product.name}</h4>
                                            </a>
                                        </div>
                                        <p>${product.description.substring(0, 100)}...</p>
                                    </div>
                                    <div class="panel-footer">
                                        <span class="pull-right">
                                            <a class="btn btn-default" href="products.php?section=product-detail&product_id=${product.product_id}">BUY NOW</a>
                                        </span>
                                        <a class="btn btn-default">$${product.price}</a>
                                    </div>
                                </div>
                            </div>
                        `;
                        productContainer.append(productCard);
                    });
                } else {
                    productContainer.html("<div class='col-12 text-center'><h3>No products found.</h3></div>");
                }
            },
            error: function (xhr) {
                console.error("AJAX Error:", xhr.responseText);
                alert("❌ Error fetching products.");
            }
        });
    }

    fetchProducts(); // ✅ Load products when the page loads
});
</script>
