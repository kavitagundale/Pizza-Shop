<?php
include 'database.php';

if (isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET status='$status' WHERE id=$order_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect to orders.php to prevent form resubmission on refresh
        header("Location: order.php");
        exit(); // Stop further execution
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
