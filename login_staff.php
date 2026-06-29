<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login_staff'])) {
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
    $staff_username = $conn->real_escape_string($_POST['username']);
    $staff_password = $conn->real_escape_string($_POST['password']);

    // Query to fetch user from staff_data table
    $sql = "SELECT * FROM staff_data WHERE username='$staff_username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // Verify hashed password
        if (password_verify($staff_password, $stored_password)) {
            // Password is correct, redirect to staff panel
            $_SESSION['staff_username'] = $staff_username;
            header("Location: staff_panel.php");
            exit();
        } else {
            $error_message = "Incorrect password.";
        }
    } else {
        $error_message = "User not found.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100vh;
            background-color: #f9f9f9;
            font-family: 'Inter', sans-serif;
            overflow: hidden;
        }
        .login-split-container {
            display: flex;
            width: 100%;
            height: 100vh;
        }
        .login-form-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fcfcfc;
            position: relative;
            z-index: 2;
        }
        .form-wrapper {
            width: 100%;
            max-width: 400px;
            padding: 40px;
        }
        .form-wrapper h2 {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 40px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 12px;
            color: #777;
            margin-bottom: 8px;
            margin-left: 15px;
            font-weight: 500;
        }
        .form-control {
            width: 100%;
            padding: 14px 20px;
            border: 1px solid #ccc;
            border-radius: 30px;
            font-size: 15px;
            background-color: #fff;
            color: #333;
            outline: none;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #3b4d41;
        }
        .btn-login {
            width: 100%;
            padding: 14px;
            background-color: #3b4d41;
            color: #fff;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        .btn-login:hover {
            background-color: #2c3a30;
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 30px 0;
            color: #999;
            font-size: 12px;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ddd;
        }
        .divider::before { margin-right: .5em; }
        .divider::after { margin-left: .5em; }

        .social-logins {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }
        .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            border: 1px solid #ddd;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        .social-btn:hover { background: #f0f0f0; }

        .footer-links {
            text-align: center;
            font-size: 13px;
        }
        .footer-links a {
            color: #668877;
            text-decoration: none;
            display: inline-block;
            margin: 5px;
            transition: color 0.3s;
            font-weight: 500;
        }
        .footer-links a:hover { color: #3b4d41; }
        .error-message {
            color: #e74c3c;
            text-align: center;
            font-size: 14px;
            margin-bottom: 15px;
            font-weight: 500;
        }

        /* The Right Side / SVG Wavy Masking */
        .login-image-side {
            flex: 1.2;
            position: relative;
            background-image: url('assets/img/login_leaves.png');
            background-size: cover;
            background-position: center;
        }
        
        .paper-wave-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 15vw;
            height: 100%;
            z-index: 5;
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .login-image-side { display: none; }
            .login-form-side { flex: 1; }
        }
    </style>
</head>
<body>
    <div class="login-split-container">
        <div class="login-form-side">
            <div class="form-wrapper">
                <h2>Staff Login</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <label>Login, email or phone number</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    
                    <?php if (isset($error_message)) { ?>
                        <p class="error-message"><?php echo $error_message; ?></p>
                    <?php } ?>

                    <button type="submit" class="btn-login" name="login_staff">Log in</button>
                </form>



                <div class="footer-links">
                    <a href="#">Forgot login or password?</a><br><br>
                    <a href="login_customer.php">Customer Login</a> | <a href="login_admin.php">Admin Login</a><br><br>
                    <a href="Home.php" style="color: #3b4d41; font-weight: 600;"><i class="fa fa-home"></i> Back to Home</a>
                </div>
            </div>
        </div>
        
        <div class="login-image-side">
            <svg class="paper-wave-overlay" viewBox="0 0 200 1000" preserveAspectRatio="none">
                <defs>
                    <filter id="shadow" x="0" y="0" width="150%" height="100%">
                        <feDropShadow dx="15" dy="0" stdDeviation="15" flood-color="#000000" flood-opacity="0.6"/>
                    </filter>
                    <filter id="shadow-inner" x="0" y="0" width="150%" height="100%">
                        <feDropShadow dx="5" dy="0" stdDeviation="5" flood-color="#000000" flood-opacity="0.4"/>
                    </filter>
                </defs>
                <path d="M0,0 L0,1000 C60,850 160,650 40,450 C-60,250 100,100 20,0 Z" fill="#e0e0e0" filter="url(#shadow)"/>
                <path d="M0,0 L0,1000 C40,850 130,650 20,450 C-80,250 80,100 0,0 Z" fill="#fcfcfc" filter="url(#shadow-inner)"/>
            </svg>
        </div>
    </div>
</body>
</html>
