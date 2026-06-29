<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_customer'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gallery_cafe";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize user input
    $customer_username = $conn->real_escape_string($_POST['username']);
    $customer_password = $_POST['password'];
    $customer_password_confirm = $_POST['password_confirm'];

    // Check if passwords match
    if ($customer_password !== $customer_password_confirm) {
        $error_message = "Passwords do not match.";
    } else {
        // Hash the password
        $hashed_password = password_hash($customer_password, PASSWORD_DEFAULT);

        // Check if username already exists
        $sql_check = "SELECT * FROM customers WHERE username='$customer_username'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            $error_message = "Username already exists.";
        } else {
            // Insert new user into the database
            $sql_insert = "INSERT INTO customers (username, password) VALUES ('$customer_username', '$hashed_password')";
            if ($conn->query($sql_insert) === TRUE) {
                $_SESSION['customer_username'] = $customer_username;
                header("Location: Home.php");
                exit();
            } else {
                $error_message = "Error: " . $sql_insert . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFFFFF;
            color: #ffffff;
            font-family: Arial, sans-serif;
            padding: 50px;
        }
        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 30px;
            background-color: #444444;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container .form-group {
            margin-bottom: 15px;
        }
        .form-container .form-group input {
            width: 90%;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
        }
        .form-container .form-group button {
            width: 95%;
            padding: 10px;
            background-color: #ff8c00;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
        }
        .form-container .form-group button:hover {
            background-color: #e07b00;
        }
        .error-message {
            color: #ff4444;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Customer Registration</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <input type="password" name="password_confirm" class="form-control" placeholder="Confirm Password" required>
            </div>
            <?php if (isset($error_message)) { ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php } ?>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="register_customer">Register</button>
            </div>
        </form>
    </div>
</body>
</html>
