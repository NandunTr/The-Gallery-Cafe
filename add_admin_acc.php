<?php
include 'Header.php';
include 'Footer.php';
include 'dbconn.php';

// Handle form submission

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>The Gallery Cafe - Admin Registration</title>
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
    form input[type="text"], form input[type="email"], form input[type="password"], form input[type="date"], form input[type="tel"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 16px;
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

  <!-- ======= Header ======= -->
  <?php
  readheader();
  ?>

  <!-- ======= Staff Registration Section ======= -->
  <section id="admin-registration" class="admin-registration">
    <div class="container">
      <div class="section-title">
        <h2>Admin Registration</h2>
      </div>

      <!-- Staff Registration Form -->
      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
          <form action="add_admin_acc.php" method="post" class="w-75">
            <div class="form-group">
              <label for="firstname">First Name:</label>
              <input type="text" id="firstname" name="firstname" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="lastname">Last Name:</label>
              <input type="text" id="lastname" name="lastname" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="birthday">Birthday:</label>
              <input type="date" id="birthday" name="birthday" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="contact_number">Contact Number:</label>
              <input type="tel" id="contact_number" name="contact_number" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
        </div>
      </div>
      <!-- End Staff Registration Form -->

    </div>
  </section>
  <!-- End Staff Registration Section -->
   <?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $birthday = $conn->real_escape_string($_POST['birthday']);
    $contact_number = $conn->real_escape_string($_POST['contact_number']);
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO admin_data (firstname, lastname, birthday, contact_number, email, username, password) 
            VALUES ('$firstname', '$lastname', '$birthday', '$contact_number', '$email', '$username', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>New staff member added successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
   ?>

  <!-- ======= Footer ======= -->
  <?php 
  readfooter(); 
  ?>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>
