<?php
session_start();
include 'dbconn.php'; // Ensure this file contains your database connection code

// Function to retrieve available tables
function getAvailableTables($conn) {
    $sql = "SELECT * FROM tables WHERE status = 'available'";
    $result = $conn->query($sql);
    $tables = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tables[] = $row;
        }
    }
    return $tables;
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_table'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $date = $conn->real_escape_string($_POST['date']);
    $time = $conn->real_escape_string($_POST['time']);
    $people = $conn->real_escape_string($_POST['people']);
    $message = $conn->real_escape_string($_POST['message']);
    $table_id = $conn->real_escape_string($_POST['table_id']);

    // Insert reservation into 'reservations' table
    $sql = "INSERT INTO reservations (name, email, phone, date, time, people, message, table_id) 
            VALUES ('$name', '$email', '$phone', '$date', '$time', '$people', '$message', '$table_id')";

    if ($conn->query($sql) === TRUE) {
        // Update table status to 'reserved'
        $updateSql = "UPDATE tables SET status = 'reserved' WHERE id = $table_id";
        $conn->query($updateSql);

        // Send confirmation email to the customer (implement this part separately)
        // Example: mail($email, 'Reservation Confirmation', 'Your reservation details...');

        echo "<div class='alert alert-success'>Your booking request was sent successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Retrieve available tables
$tables = getAvailableTables($conn);

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Cafe - Book a Table</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<style>
    header {
  background-color: #35322d;
    }
</style>
<body>

    <!-- Header -->
    <?php include 'Header.php'; 
     readheader();?>

    <!-- Book a Table Section -->
    <section id="book-a-table" class="book-a-table">
        <div class="container">
            <div class="section-title">
                <h2>Book a <span>Table</span></h2>
                <p>Please fill out the form below to reserve a table.</p>
            </div>

            <form action="book_table.php" method="post" class="php-email-form">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control" name="phone" placeholder="Your Phone" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <input type="text" name="date" class="form-control" placeholder="Date" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control" name="time" placeholder="Time" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <input type="number" class="form-control" name="people" placeholder="# of people" required>
                    </div>
                    <div class="col-md-12 form-group">
                        <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="table_id">Select Table:</label>
                        <select name="table_id" id="table_id" class="form-control" required>
                            <option value="">Select a Table</option>
                            <?php foreach ($tables as $table): ?>
                                <option value="<?php echo $table['id']; ?>"><?php echo $table['table_number']; ?> (Capacity: <?php echo $table['capacity']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <button type="submit" name="book_table" class="btn btn-primary">Book a Table</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <?php 
  include 'Footer.php';
  readfooter(); 
  ?>

    <!-- Vendor JS Files -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
