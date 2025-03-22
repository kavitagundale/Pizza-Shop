<?php include 'database.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Pizza</title>
    <link rel="stylesheet" href="style.css">

    <style>
      body {
    font-family: Arial, sans-serif;
    background-color: #ffefd5; /* Light pizza crust color */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

h2 {
    text-align: center;
    color: #d35400; /* Warm pizza sauce color */
}

form {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    width: 350px;
    text-align: center;
}

label {
    display: block;
    text-align: left;
    font-weight: bold;
    margin-top: 10px;
    color: #2c3e50;
}

input, textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

input:focus, textarea:focus {
    outline: none;
    border: 1px solid #e67e22;
    box-shadow: 0px 0px 5px rgba(230, 126, 34, 0.5);
}

textarea {
    resize: none;
    height: 80px;
}

input[readonly] {
    background-color: #f9f9f9;
    font-weight: bold;
    color: #555;
}

input[type="submit"] {
    background: #e74c3c;
    color: white;
    font-size: 18px;
    font-weight: bold;
    border: none;
    padding: 12px;
    margin-top: 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s ease-in-out;
}

input[type="submit"]:hover {
    background: #c0392b;
}
    </style>
</head>
<body>

<h2>Order Your Pizza</h2>

<?php
$pizza_name = isset($_GET['pizza_name']) ? $_GET['pizza_name'] : 'Not Selected';
$price = isset($_GET['price']) ? $_GET['price'] : 0;
?>

<form action="process_order.php" method="POST">
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Phone:</label>
    <input type="text" name="phone" required>

    <label>Address:</label>
    <textarea name="address" required></textarea>

    <label>Pizza:</label>
    <input type="text" name="pizza_name" value="<?php echo $pizza_name; ?>" readonly>

    <label>Price:</label>
    <input type="text" name="price" value="<?php echo $price; ?>" readonly>

    <input type="submit" name="order" value="Place Order">
</form>

</body>
</html>
