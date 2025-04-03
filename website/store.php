<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'partial-files/head.html'; ?>
    </head>
    <body>

    <?php require 'partial-files/menu.html'; ?>

        <form class="search-bar">
            <input type="text" id="search-input" placeholder="search...."/>
            <button type="submit">🔍</button>
        </form>
    
        <div class="slider-container">
            <img src="../assets/img/agric-commodities.JPEG" height="300px" width="100%">
            <div class="slider-text">Shop quality <strong>organic</strong> Foods here!</div>
        </div>
    
        
<!-- ✅ Your HTML -->
<div>
    <h1 class="course-heading">SHOP</h1>
    <div class="row" id="productContainer">
        <!-- Products will be loaded here dynamically -->
    </div>
</div>

<!-- ✅ AJAX Script -->
<script>
$(document).ready(function () {
    function fetchProducts() {
        $.ajax({
            url: "api/get_products.php", // ✅ API path
            type: "GET",
            dataType: "json",
            success: function (response) {
                let productContainer = $("#productContainer");
                productContainer.empty(); // ✅ Clear previous content

                if (response.status === "success" && response.data.length > 0) {
                    response.data.forEach(function (product) {
                        let productImage = product.image_url ? `../secure_pages/api/uploads/products/${product.image_url}` : "../secure_pages/dash-assets/img/cropper/1.jpg";
                        let profileImage = "../secure_pages/dash-assets/img/contact/2.jpg"; // Placeholder profile image

                        let productCard = `
            <a href="../secure_pages/products.php?section=product-detail&product_id=${product.product_id}">
                <div class="col-3">
                    <div class="course-image"> 
                        <img src="${productImage}" alt="Product Image">
                        <h3 class="course-title">${product.name}</h3>
                    </div>
                </a>
                <div class="row">
                    <div class="col-4">
                        <h3 class="course-price">$${product.price}</h3>
                    </div>
                    <div class="col-4">
                        <button class="course-btn">
                            <a href="../secure_pages/products.php?section=product-detail&product_id=${product.product_id}">Buy Now</a>
                        </button>  
                    </div>
                    <div class="col-4">
                        <button class="course-btn">
                            <a href="../secure_pages/products.php?section=product-detail&product_id=${product.product_id}">Add to cart</a>
                        </button>
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
    </body>
</html>