<?php
include 'Header.php';

include 'dbconn.php';
session_start();

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

// Handle reservation request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserve'])) {
    $space_id = $_POST['space_id'];
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $customer_contact = $conn->real_escape_string($_POST['customer_contact']);
    $reserved_from = $_POST['reserved_from'];
    $reserved_to = $_POST['reserved_to'];

    // Check if space is available
    $check_sql = "SELECT * FROM parking_spaces WHERE id='$space_id' AND status='available'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows == 1) {
        // Update parking space status
        $update_sql = "UPDATE parking_spaces SET status='occupied', customer_name='$customer_name', customer_contact='$customer_contact', reserved_from='$reserved_from', reserved_to='$reserved_to' WHERE id='$space_id'";
        if ($conn->query($update_sql) === TRUE) {
            $success_message = "Parking space reserved successfully.";
        } else {
            $error_message = "Error updating record: " . $conn->error;
        }
    } else {
        $error_message = "Parking space is not available.";
    }
}

// Fetch parking spaces
$sql = "SELECT * FROM parking_spaces";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Availability</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            padding: 50px;
        }
        .container {
            max-width: 900px;
            margin: auto;
        }
        .parking-lot-container {
            max-width: 1000px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid #eaeaea;
        }
        .parking-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            gap: 15px;
            justify-items: center;
        }
        .parking-slot {
            width: 100%;
            aspect-ratio: 4/5;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            background-color: #fcfcfc;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .parking-slot.available:hover {
            border-color: #D59B51;
            background-color: #fff9f0;
            box-shadow: inset 0 0 0 2px #D59B51;
        }
        .parking-slot.occupied {
            cursor: not-allowed;
            background-color: #f0f0f0;
        }
        .slot-number {
            font-size: 18px;
            font-weight: 500;
            color: #888;
        }
        .slot-car-img {
            width: 70%;
            height: 90%;
            object-fit: contain;
            filter: drop-shadow(0 5px 5px rgba(0,0,0,0.3));
        }
        .modal-header {
            background-color: #007bff;
            color: white;
        }
        .modal-footer .btn {
            background-color: #007bff;
            color: white;
        }
        .modal-footer .btn:hover {
            background-color: #0056b3;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<style>
    header {
  background-color: #35322d;
    }
</style>
<body>
<?php
  readheader();
  ?>
    <div class="container">
        <h1>_</h1>
        <h2 class="text-center mb-4">Parking Availability</h2>

        <?php if (isset($success_message)) { ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php } ?>
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php } ?>

        <div class="parking-lot-container">
            <div class="parking-grid">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <?php if ($row['status'] == 'occupied') { ?>
                        <div class="parking-slot occupied" title="Reserved By: <?php echo htmlspecialchars($row['customer_name']); ?>&#10;From: <?php echo date('d-m-Y H:i', strtotime($row['reserved_from'])); ?>&#10;To: <?php echo date('d-m-Y H:i', strtotime($row['reserved_to'])); ?>">
                            <img src="assets/img/top_down_car.png" alt="Car" class="slot-car-img">
                        </div>
                    <?php } else { ?>
                        <div class="parking-slot available" data-toggle="modal" data-target="#reserveModal" data-spaceid="<?php echo $row['id']; ?>" data-space="<?php echo htmlspecialchars($row['space_number']); ?>">
                            <span class="slot-number"><?php echo htmlspecialchars($row['space_number']); ?></span>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Reserve Modal -->
    <div class="modal fade" id="reserveModal" tabindex="-1" role="dialog" aria-labelledby="reserveModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reserveModalLabel">Reserve Parking Space</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <input type="hidden" name="space_id" id="space_id">
                        <div class="form-group">
                            <label for="customer_name">Customer Name</label>
                            <input type="text" class="form-control" name="customer_name" id="customer_name" required>
                        </div>
                        <div class="form-group">
                            <label for="customer_contact">Customer Contact</label>
                            <input type="text" class="form-control" name="customer_contact" id="customer_contact" required>
                        </div>
                        <div class="form-group">
                            <label for="reserved_from">Reserved From</label>
                            <input type="datetime-local" class="form-control" name="reserved_from" id="reserved_from" required>
                        </div>
                        <div class="form-group">
                            <label for="reserved_to">Reserved To</label>
                            <input type="datetime-local" class="form-control" name="reserved_to" id="reserved_to" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="reserve">Reserve</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#reserveModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var spaceId = button.data('spaceid');
            var spaceNumber = button.data('space');

            var modal = $(this);
            modal.find('.modal-title').text('Reserve Parking Space ' + spaceNumber);
            modal.find('#space_id').val(spaceId);
        });
    </script>
    <?php 
  include 'Footer.php';
  readfooter(); 
  ?>
</body>
</html>
