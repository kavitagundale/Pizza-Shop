<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
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
        .login-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        h2 {
            color: #d35400; /* Pizza sauce color */
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        input:focus {
            outline: none;
            border: 1px solid #e67e22;
            box-shadow: 0px 0px 5px rgba(230, 126, 34, 0.5);
        }
        button {
            background: #e74c3c;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border: none;
            padding: 12px;
            margin-top: 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: 0.3s ease-in-out;
        }
        button:hover {
            background: #c0392b;
        }
        .signup-btn {
            background: #2980b9; /* Blue color for Signup */
            text-decoration: none;
            display: inline-block;
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }
        .signup-btn:hover {
            background: #1f618d;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    <form method="POST">
        <input type="text" name="username" required placeholder="Username">
        <input type="password" name="password" required placeholder="Password">
        <button type="submit">Login</button>
    </form>
    <a href="register.php" class="signup-btn">Sign Up</a> <!-- Signup button -->
</div>

</body>
</html>
