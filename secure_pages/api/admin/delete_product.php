<?php
require '../config.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $product_id = $_GET["id"]; // Get the product ID from the URL

    try {
        // ✅ Check if the product exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM products WHERE product_id = ?");
        $stmt->execute([$product_id]);
        $productExists = $stmt->fetchColumn();

        if ($productExists > 0) {
            // ✅ Delete the product
            $stmt = $pdo->prepare("DELETE FROM products WHERE product_id = ?");
            $stmt->execute([$product_id]);

            // ✅ Redirect to the products page with a success message
            header("Location: ../../products.php?section=products&message=Product+deleted+successfully");
            exit;
        } else {
            // ✅ Redirect if product does not exist
            header("Location: ../../products.php?section=products&error=Product+not+found");
            exit;
        }
    } catch (PDOException $e) {
        // ✅ Redirect with an error message if deletion fails
        header("Location: ../../products.php?section=products&error=Failed+to+delete+product");
        exit;
    }
} else {
    // ✅ Redirect if no valid product ID is provided
    header("Location: ../../products.php?section=products&error=Invalid+request");
    exit;
}
?>
