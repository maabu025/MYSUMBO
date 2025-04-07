<div class="container mt-4">
    <h2>User Orders</h2>

    <!-- Search Input -->
    <input type="text" id="search" class="form-control mb-3" placeholder="Search orders...">

    <!-- Orders Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="ordersTableBody">
            <tr><td colspan="5" class="text-center">Loading orders...</td></tr>
        </tbody>
    </table>
</div>

<!-- jQuery for AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    function fetchOrders(search = '') {
        $.ajax({
            url: "api/admin/get-orders.php",
            type: "GET",
            data: { search: search },
            success: function (response) {
                $("#ordersTableBody").html(response);
            },
            error: function () {
                $("#ordersTableBody").html('<tr><td colspan="5" class="text-center">❌ Error fetching orders.</td></tr>');
            }
        });
    }

    // Load all orders by default
    fetchOrders();

    // Search orders dynamically
    $("#search").on("keyup", function () {
        let searchValue = $(this).val();
        fetchOrders(searchValue);
    });
});
</script>
