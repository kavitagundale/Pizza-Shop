<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user_id'])) {
    die("Please <a href='login.php'>login</a> to place an order.");
}

$message = ""; // Initialize message variable
$success = false; // Track order success status

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $pizza_name = htmlspecialchars($_POST['pizza_name']);

    // Define pizza prices
    $prices = [
        "Italian Pizza" => 180,
        "Greek Pizza" => 199,
        "Caucasian Pizza" => 120,
        "Margherita" => 150
    ];

    // Validate pizza selection
    if (!isset($prices[$pizza_name])) {
        $message = "Invalid pizza selection.";
    } else {
        $price = $prices[$pizza_name];

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO orders (user_id, name, phone, address, pizza_name, price, status) VALUES (?, ?, ?, ?, ?, ?, 'Pending')");
        $stmt->bind_param("issssi", $user_id, $name, $phone, $address, $pizza_name, $price);

        if ($stmt->execute()) {
            $message = "Order placed successfully!";
            $success = true;
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            text-align: center;
            margin: 0;
            padding: 40px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #e74c3c;
        }
        p {
            font-size: 18px;
            color: #333;
        }
        .success {
            color: #27ae60;
            font-size: 20px;
            font-weight: bold;
        }
        .error {
            color: #e74c3c;
            font-size: 20px;
            font-weight: bold;
        }
        .order-details {
            background: #f2f2f2;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .order-details p {
            margin: 5px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn-home {
            background: #e67e22;
            color: white;
            border: none;
        }
        .btn-home:hover {
            background: #d35400;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Order Confirmation</h2>
    <p class="<?= $success ? 'success' : 'error' ?>">
        <?= $message ?>
    </p>

    <?php if ($success) { ?>
        <div class="order-details">
            <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($phone) ?></p>
            <p><strong>Address:</strong> <?= htmlspecialchars($address) ?></p>
            <p><strong>Pizza:</strong> <?= htmlspecialchars($pizza_name) ?></p>
            <p><strong>Price:</strong> ₹<?= $price ?></p>
        </div>
    <?php } ?>

    <a href="index.php" class="btn btn-home">Back to Home</a>
</div>

</body>
</html>
