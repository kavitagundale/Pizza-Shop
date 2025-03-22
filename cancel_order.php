<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to cancel an order.";
    exit;
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $user_id = $_SESSION['user_id'];

    // Ensure the order belongs to the logged-in user before canceling
    $sql = "DELETE FROM orders WHERE id = '$order_id' AND user_id = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Order canceled successfully!";
    } else {
        echo "Error canceling order: " . $conn->error;
    }
}
?>
