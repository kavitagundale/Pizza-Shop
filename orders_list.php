<?php
session_start(); // Start the session
include 'database.php';

$sql = "SELECT * FROM orders ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Orders List</title>
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
      .status-select {
          padding: 5px;
          border-radius: 5px;
      }
      .update-btn {
          background: #27ae60;
          color: white;
          border: none;
          padding: 5px 10px;
          border-radius: 5px;
          cursor: pointer;
      }
      .cancel-btn {
          background: #e74c3c;
          color: white;
          padding: 5px 10px;
          border-radius: 5px;
          text-decoration: none;
          font-weight: bold;
      }
      .cancel-btn:hover {
          background: #c0392b;
      }
    </style>
</head>
<body>
    <h2>Orders</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Pizza</th>
            <th>Price</th>
            <th>Status</th>
            <th>Order Time</th>
            <th>Update</th>
            <th>Cancel</th> <!-- New column for the cancel button -->
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['address'] ?></td>
            <td><?= $row['pizza_name'] ?></td>
            <td>₹<?= $row['price'] ?></td>
            <td>
                <form action="update_status.php" method="POST">
                    <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                    <select name="status" class="status-select">
                        <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="Processing" <?= $row['status'] == 'Processing' ? 'selected' : '' ?>>Processing</option>
                        <option value="Completed" <?= $row['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                        <option value="Cancelled" <?= $row['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                    </select>
                    <button type="submit" class="update-btn">Update</button>
                </form>
            </td>
            <td><?= $row['created_at'] ?></td>
            <td>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['user_id']) { ?>
                    <a href="cancel_order.php?order_id=<?= $row['id'] ?>" class="cancel-btn" onclick="return confirm('Are you sure you want to cancel this order?')">Cancel</a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
