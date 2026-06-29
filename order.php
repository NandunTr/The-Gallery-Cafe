<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 0;
            margin: 0;
        }
        .order-form {
            padding: 60px 0;
            background-color: #f8f9fa;
        }
        .order-form .section-title h2 {
            font-size: 32px;
            margin-bottom: 20px;
            text-align: center;
        }
        .order-form .section-title p {
            text-align: center;
            margin-bottom: 40px;
        }
        .order-form .form-group {
            margin-bottom: 20px;
        }
        .order-form .form-group input, 
        .order-form .form-group select, 
        .order-form .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .order-form .form-group button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        .order-form .form-group button:hover {
            background-color: #0056b3;
        }
        .success-message, .error-message {
            display: none;
            text-align: center;
            margin: 20px 0;
        }
        .success-message {
            color: #28a745;
        }
        .error-message {
            color: #dc3545;
        }
    </style>
</head>
<body>

<section id="order" class="order-form">
    <div class="container">
        <div class="section-title">
            <h2><span>Order</span> Online</h2>
            <p>Place your order online and enjoy our delicious meals delivered to your doorstep.</p>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            $name = $conn->real_escape_string($_POST['name']);
            $email = $conn->real_escape_string($_POST['email']);
            $phone = $conn->real_escape_string($_POST['phone']);
            $address = $conn->real_escape_string($_POST['address']);
            $menu_item = $conn->real_escape_string($_POST['menu_item']);
            $beverage = $conn->real_escape_string($_POST['beverage']);
            $order_details = $conn->real_escape_string($_POST['order_details']);
            $total_price = $conn->real_escape_string($_POST['total_price']);

            // Insert data into the database
            $sql = "INSERT INTO orders (name, email, phone, address, order_details, total_price) VALUES ('$name', '$email', '$phone', '$address', 'Menu Item: $menu_item, Beverage: $beverage, $order_details', '$total_price')";

            if ($conn->query($sql) === TRUE) {
                echo '<div class="success-message">Your order has been placed successfully. Thank you!</div>';
            } else {
                echo '<div class="error-message">Error: ' . $sql . '<br>' . $conn->error . '</div>';
            }

            $conn->close();
        }
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="text" name="phone" class="form-control" placeholder="Your Phone Number" required>
                </div>
                <div class="col-md-6 form-group">
                    <input type="text" name="address" class="form-control" placeholder="Delivery Address" required>
                </div>
            </div>
            <div class="form-group">
                <label for="menu_item">Select Menu Item:</label>
                <select name="menu_item" id="menu_item" class="form-control" required>
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'gallery_cafe');
                    $result = $conn->query("SELECT * FROM food_menu");
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['name'] . '">' . $row['name'] . ' - Rs.' . $row['price'] . '</option>';
                    }
                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="beverage">Select Beverage:</label>
                <select name="beverage" id="beverage" class="form-control" required>
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'gallery_cafe');
                    $result = $conn->query("SELECT * FROM beverages");
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['name'] . '">' . $row['name'] . ' - Rs.' . $row['price'] . '</option>';
                    }
                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="form-group">
                <textarea name="order_details" class="form-control" rows="5" placeholder="Additional Order Details (optional)"></textarea>
            </div>
            <div class="form-group">
                <input type="number" name="total_price" class="form-control" placeholder="Total Price" required>
            </div>
            <div class="text-center">
                <button type="submit">Place Order</button>
            </div>
        </form>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
