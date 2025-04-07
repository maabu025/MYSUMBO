<?php
$user_role = $_SESSION['role'] ?? 'user'; // Default to 'user' if role not set
?>
<div class="container mt-4">
<h2>Admin Orders</h2>
    
<input type="text" id="orderSearch" placeholder="Search Orders..." style="color: white; text-align: center;" />

<table class="table">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Order Date</th>
            <th>Total Amount</th>
            <th>Order Status</th>
            <th>Payment Status</th>
        </tr>
    </thead>
    <tbody id="ordersTableBody">
        <tr><td colspan="7" class="text-center">Loading orders...</td></tr>
    </tbody>
</table>

</div>


<script>
$(document).ready(function () {
    function fetchOrders() {
        var userRole = "<?php echo $user_role; ?>"; // Get the user role from PHP session
        $.ajax({
            url: "api/admin/get-orders.php",
            type: "GET",
            dataType: "json",
            success: function (data) {
                let tableBody = $("#ordersTableBody");
                tableBody.empty();

                if (data.length === 0) {
                    tableBody.append("<tr><td colspan='7' class='text-center'>No orders found.</td></tr>");
                    return;
                }

                $.each(data, function (index, order) {
                    let statusDropdown = userRole === "admin" ? `
                        <select class="status-select" data-order="${order.order_id}" style="background-color: ${order.order_status === "Pending" ? "#f0ad4e" : order.order_status === "Paid" ? "#5cb85c" : "#d9534f"}; color: white;">
                            <option value="Pending" ${order.order_status === "Pending" ? "selected" : ""}>Pending</option>
                            <option value="Shipped" ${order.order_status === "Shipped" ? "selected" : ""}>Shipped</option>
                            <option value="Delivered" ${order.order_status === "Delivered" ? "selected" : ""}>Delivered</option>
                            <option value="Processing" ${order.order_status === "Processing" ? "selected" : ""}>Processing</option>  
                            <option value="Cancelled" ${order.order_status === "Cancelled" ? "selected" : ""}>Cancelled</option>   
                        </select>` : `<span>${order.order_status}</span>`;

                    let paymentDropdown = userRole === "admin" ? `
                        <select class="payment-select" data-payment="${order.payment_id}" style="background-color: ${order.order_status === "Pending" ? "#f0ad4e" : order.order_status === "Paid" ? "#5cb85c" : "#d9534f"}; color: white;">
                            <option value="Pending" ${order.payment_status === "Pending" ? "selected" : ""}>Pending</option>
                            <option value="Completed" ${order.payment_status === "Completed" ? "selected" : ""}>Completed</option>
                            <option value="Failed" ${order.payment_status === "Failed" ? "selected" : ""}>Failed</option>
                        </select>` : `<span>${order.payment_status}</span>`;

                    tableBody.append(`
                        <tr>
                            <td>${order.order_id}</td>
                            <td>${order.first_name} ${order.last_name}</td>
                            <td>${order.order_date}</td>
                            <td>$${order.total_amount}</td>
                            <td>${statusDropdown}</td>
                            <td>${paymentDropdown}</td>
                        </tr>
                    `);
                });

                // Admin-only events
                if (userRole === "admin") {
                    $(".status-select").change(function () {
                        let orderId = $(this).data("order");
                        let newStatus = $(this).val();
                        updateOrderStatus(orderId, newStatus);
                    });

                    $(".payment-select").change(function () {
                        let paymentId = $(this).data("payment");
                        let newStatus = $(this).val();
                        updatePaymentStatus(paymentId, newStatus);
                    });
                }
            },
            error: function (xhr) {
                console.error("Error fetching orders:", xhr.responseText);
            }
        });
    }

    function updateOrderStatus(orderId, status) {
        $.ajax({
            url: "api/admin/update_order_status.php",
            type: "POST",
            data: { order_id: orderId, status: status },
            success: function () {
                alert("Order status updated successfully!");
                fetchOrders();
            },
            error: function (xhr) {
                console.error("Error updating order status:", xhr.responseText);
            }
        });
    }

    function updatePaymentStatus(paymentId, status) {
        $.ajax({
            url: "api/admin/update_payment_status.php",
            type: "POST",
            data: { payment_id: paymentId, status: status },
            success: function () {
                alert("Payment status updated successfully!");
                fetchOrders();
            },
            error: function (xhr) {
                console.error("Error updating payment status:", xhr.responseText);
            }
        });
    }

    fetchOrders();
});
</script>
