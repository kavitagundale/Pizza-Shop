<?php
session_start();
include 'database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user's orders
$sql = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Orders</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #e74c3c;
            margin-bottom: 20px;
        }
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #e67e22;
            color: white;
            text-transform: uppercase;
        }
        tr:hover {
            background: #f2f2f2;
        }
        .cancel-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .cancel-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>

<h2>My Orders</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Pizza</th>
        <th>Price</th>
        <th>Status</th>
        <th>Order Time</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['phone'] ?></td>
        <td><?= $row['address'] ?></td>
        <td><?= $row['pizza_name'] ?></td>
        <td>₹<?= $row['price'] ?></td>
        <td><?= $row['status'] ?></td>
        <td><?= $row['created_at'] ?></td>
        <td>
            <?php if ($row['status'] == 'Pending') { ?>
                <a href="cancel_order.php?order_id=<?= $row['id'] ?>" class="cancel-btn" onclick="return confirm('Are you sure you want to cancel this order?')">Cancel</a>
            <?php } else { ?>
                <span style="color: gray;">Not Cancelable</span>
            <?php } ?>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
