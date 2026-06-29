
<!DOCTYPE html>
<html lang="en">
<head>
<style>
#header {
  top: 0;
  height: 70px;
  z-index: 997;
  transition: all 0.5s;
  padding: 15px 0;
  background: rgba(22, 22, 22, 0.7);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

#header.header-transparent {
  background: transparent;
  border-bottom: transparent;
}

#header.header-scrolled {
  top: 0;
  background: rgba(22, 22, 22, 0.85);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

#header .logo h1 {
  font-family: 'Playfair Display', serif;
  font-size: 26px;
  margin: 0;
  line-height: 1;
  font-weight: 500;
  letter-spacing: 2px;
  color: #D59B51;
}

#header .logo h1 a,
#header .logo h1 a:hover {
  color: #D59B51;
  text-decoration: none;
}

#header .logo img {
  padding: 0;
  margin: 0;
  max-height: 40px;
}
  </style>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">

  
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<?php
function readheader(){
  echo'
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <div class="logo me-auto">
        <h1><a href="Home.php">The Gallery Café</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      
      <!-- ======= navigation bar start ======= -->
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto" href="Home.php">Home</a></li>
          <li><a class="nav-link scrollto" href="Home.php#about">About</a></li>
         
          <li class="dropdown"><a href="#"><span>Menu</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
             
              <li><a href="menu foods.php">Foods</a></li>
              <li><a href="menu beveragers.php">Beavarages</a></li>

            </ul>
          </li>
          <li><a class="nav-link scrollto" href="parking.php">Parking</a></li>

          <li><a class="nav-link scrollto" href="contact.php">Contact Us</a></li>
          <li><a class="nav-link scrollto" href="Home.php#gallery">Gallery</a></li>
           
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

      <a href="login_customer.php" class="book-a-table-btn scrollto">Login</a>

    </div>
  </header><!-- End Header -->';
}
?>


    
    <!-- Your page content goes here -->


</body>
</html>


