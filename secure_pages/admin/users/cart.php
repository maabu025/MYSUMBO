<?php
include "api/config.php";

// If user clicks "Pay Now" on a course, add it to the cart
if (isset($_GET['id']) && isset($_GET['title']) && isset($_GET['price']) && isset($_GET['image']) && isset($_GET['type'])) {
    $item = [
        "id" => $_GET['course_id'],
        "title" => $_GET['title'],
        "price" => $_GET['price'],
        "image" => $_GET['image'] ? "uploads/courses/" . $_GET['image'] : "dash-assets/img/product/" . $_GET['image'],
        "type" => $_GET['type'],
        "quantity" => 1
    ];

    // Store course in session as a single-item cart
    $_SESSION['cart'] = [$item];
} elseif (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cartItems = $_SESSION['cart'];
?>
<div class="product-cart-area mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-cart-inner">
                    <form id="cart-form">
                        <section>
                            <h3>Your Cart</h3>
                            <div class="product-list-cart">
                            <table class="table table-bordered">
                            <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            foreach ($cartItems as $index => $item) {
                $total += $item["price"] * $item["quantity"];
                echo "<tr>
                        <td><img src='{$item["image"]}' width='50'></td>
                        <td>{$item["title"]}</td>
                        <td>{$item["type"]}</td>
                        <td><input type='number' class='form-control quantity' value='{$item["quantity"]}' min='1'></td>
                        <td>\${$item["price"]}</td>
                        <td><button class='btn btn-danger btn-sm remove-item' data-index='{$index}'>Remove</button></td>
                      </tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-end"><strong>Total:</strong></td>
                <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
                <td></td>
            </tr>
        </tfoot>
    </table>

                            </div>
                        </section>

                        <br>

                        <section>
                            <div style="text-align: center;">
        <button id="checkout-btn"  type="submit" class="btn btn-success">Checkout</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Cart Management -->
<script>
   $(document).ready(function() {
    $(".remove-item").click(function() {
        let index = $(this).data("index");
        $.post("remove-item.php", { index: index }, function() {
            location.reload();
        });
    });

    $("#cart-form").submit(function(e) {
        e.preventDefault();
        $.post("checkout.php", function(response) {
            alert("✅ Order placed successfully!");
            location.href = "order-success.php";
        });
    });
});

</script>
