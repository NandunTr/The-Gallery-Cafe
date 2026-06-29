<?php

include 'dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>The Gallery Cafe - Add Beverage</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      line-height: 1.6;
      background-color: #f8f9fa;
    }
    header {
      background-color: #af4261;
      color: #fff;
      padding: 10px 0;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .container {
      max-width: 900px;
      margin: auto;
      padding: 20px;
    }
    .section-title {
      text-align: center;
      margin-bottom: 40px;
    }
    form {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    form label {
      font-weight: bold;
      color: #555;
    }
    form .form-group {
      margin-bottom: 20px;
    }
    form input[type="text"], form select, form textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 16px;
    }
    form textarea {
      min-height: 100px;
    }
    form button {
      background-color: #af4261;
      color: #fff;
      border: none;
      padding: 12px 20px;
      cursor: pointer;
      border-radius: 5px;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }
    form button:hover {
      background-color: #f3ec78;
      color: #af4261;
    }
    .alert {
      margin-top: 20px;
      padding: 15px;
      border-radius: 5px;
    }
    .alert-success {
      background-color: #d4edda;
      border-color: #c3e6cb;
      color: #155724;
    }
    .alert-danger {
      background-color: #f8d7da;
      border-color: #f5c6cb;
      color: #721c24;
    }
    footer {
      background-color: #af4261;
      color: #fff;
      text-align: center;
      padding: 20px 0;
      margin-top: 20px;
    }
    footer a {
      color: #fff;
      text-decoration: none;
      font-weight: bold;
    }
    .social-links a {
      font-size: 24px;
      margin: 0 10px;
    }
  </style>
</head>
<body>



  <!-- ======= Menu Section ======= -->
  <section id="menu" class="menu">
    <div class="container">
      <div class="section-title">
        <h2>Add <span>Beverages</span></h2>
      </div>

      <!-- Add Beverage Item Form -->
      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="w-75">
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="description">Description:</label>
              <textarea id="description" name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
              <label for="price">Price:</label>
              <input type="text" id="price" name="price" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Beverage Item</button>
          </form>
        </div>
      </div>
      <!-- End Add Beverage Item Form -->

      <!-- Display Added Beverages -->
      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
          <?php
          
          // Handle form submission
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $name = $conn->real_escape_string($_POST['name']);
              $description = $conn->real_escape_string($_POST['description']);
              $price = $conn->real_escape_string($_POST['price']);

              $sql = "INSERT INTO beverages (name, description, price) 
                      VALUES ('$name', '$description', '$price')";

              if ($conn->query($sql) === TRUE) {
                  echo "<div class='alert alert-success'>New beverage item added successfully</div>";
              } else {
                  echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
              }
          }

          // Fetch and display beverages
          $sql = "SELECT name, category, country, description, price FROM beverages ORDER BY name";
          $result = $conn->query($sql);

 

          $conn->close();
          ?>
        </div>
      </div>
      <!-- End Display Added Beverages -->

    </div>
  </section>


  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>
