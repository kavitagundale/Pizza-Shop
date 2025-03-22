<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Check if the username or email already exists
        $check_sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $result = $conn->query($check_sql);
        if ($result->num_rows > 0) {
            $error = "Username or Email already exists!";
        } else {
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
            if ($conn->query($sql) === TRUE) {
                header("Location: login.php"); // Redirect to login page after successful signup
                exit();
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
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
        .register-container {
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
        .login-btn {
            background: #2980b9; /* Blue color for Login */
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
        .login-btn:hover {
            background: #1f618d;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Register</h2>
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    <form method="POST">
        <input type="text" name="username" required placeholder="Username">
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Password">
        <input type="password" name="confirm_password" required placeholder="Confirm Password">
        <button type="submit">Register</button>
    </form>
    <a href="login.php" class="login-btn">Already have an account? Login</a>
</div>

</body>
</html>
