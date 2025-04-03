<!-- product Details Section -->
<div class="single-product-tab-area mg-t-0 mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-product-pr">
                    <div class="row">
                        <!-- product Image -->
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <div class="tab-content">
                                <div class="product-tab-list tab-pane fade active in" id="product-image">
                                    <img id="productImage" src="dash-assets/img/product/bg-1.jpg" alt="product Image" />
                                </div>
                            </div>
                        </div>

                        <!-- product Details -->
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                            <div class="single-product-details res-pro-tb">
                                <h1 id="ProductTitle">Product Name</h1>
                                <span class="single-pro-star">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                                <div class="single-pro-price">
                                    <span class="single-regular" id="productPrice">$0.00</span>
                                </div>
                                <div class="single-pro-cn">
                                    <h3>Category</h3>
                                    <p id="productCategory">Category Name</p>
                                    <h3>Overview</h3>
                                    <p id="productDescription">Loading...</p>
                                </div>
                                <div class="single-pro-button">
                                    <div class="pro-button">
                                        <a href="" id="enrollNowBtn">PAY NOW</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-social-area">
                                    <h3>Share this on</h3>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-feed"></i></a>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    function fetchproductDetails() {
        const urlParams = new URLSearchParams(window.location.search);
        const productId = urlParams.get("product_id");

        if (!productId) {
            alert("❌ No product ID provided.");
            return;
        }

        $.ajax({
            url: "api/admin/get_product_details.php?id=" + productId, // ✅ API call
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    let product = response.data;

                    $("#productImage").attr("src", product.image_url ? "uploads/products/" + product.image_url : "dash-assets/img/product/bg-1.jpg");
                    $("#productTitle").text(product.name);
                    $("#productPrice").text("$" + product.price);
                    $("#productCategory").text(product.category_name);
                    $("#productDescription").text(product.description);
                    $("#enrollNowBtn").attr("href", "api/admin/process_checkout.php?id=" + product.product_id + "&type=product&title=" + product.name + "&price=" + product.price + "&image=" + encodeURIComponent(product.image_url));
                } else {
                    $(".single-product-tab-area").html("<h2 class='text-center'>❌ product not found.</h2>");
                }
            },
            error: function (xhr) {
                console.error("AJAX Error:", xhr.responseText);
                alert("❌ Error fetching product details.");
            }
        });
    }

    fetchproductDetails(); // ✅ Load product details when the page loads
});
</script>