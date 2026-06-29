<?php
include 'Header.php';
include 'dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>The Gallery Cafe - Menu</title>
  
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #a4b0bc; /* Slate blue */
      font-family: 'Inter', sans-serif;
      overflow-x: hidden;
      margin: 0;
      padding: 0;
    }

    /* Prevent header overlapping content too much */
    .menu-layout-wrapper {
      position: relative;
      width: 100%;
      max-width: 1000px;
      margin: 120px auto 50px auto;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-bottom: 80px;
    }

    /* Central Pillar */
    .menu-pillar {
      position: absolute;
      top: 0;
      bottom: -50px;
      left: 50%;
      transform: translateX(-50%);
      width: 380px;
      background-color: #050514; /* Very dark navy */
      z-index: 1;
    }

    /* Pillar Grommet Holes */
    .pillar-holes {
      position: absolute;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 30px;
      z-index: 2;
    }
    .pillar-hole {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      border: 5px solid #d0a866; /* Gold grommet */
      background-color: #a4b0bc; 
      box-shadow: inset 0 5px 10px rgba(0,0,0,0.5), 0 2px 5px rgba(0,0,0,0.3);
    }

    .menu-section {
      position: relative;
      width: 100%;
      z-index: 10;
      margin-top: 100px;
      margin-bottom: 60px;
      display: flex;
      flex-direction: column;
    }

    /* Alternate alignments */
    .section-about { align-items: flex-end; padding-right: 120px; }
    .section-menu { align-items: flex-start; padding-left: 120px; margin-top: 150px; }
    .section-special { align-items: flex-end; padding-right: 120px; margin-top: 150px; }
    .section-book { align-items: flex-start; padding-left: 120px; margin-top: 150px; }

    .massive-title {
      font-family: 'Inter', sans-serif;
      font-size: 80px;
      font-weight: 300;
      letter-spacing: 35px;
      color: #ffffff;
      text-transform: uppercase;
      position: absolute;
      z-index: 15;
      pointer-events: none;
    }

    /* Title positions */
    .section-about .massive-title { top: -60px; left: calc(50% - 210px); }
    .section-menu .massive-title { top: -80px; left: calc(50% - 150px); }
    .section-special .massive-title { top: -70px; left: calc(50% - 280px); }
    .section-book .massive-title { top: -90px; left: calc(50% - 120px); }

    .menu-card {
      background-color: #3b4055; /* Slate card */
      padding: 50px 60px;
      width: 550px;
      position: relative;
      z-index: 10;
      box-shadow: 0 30px 50px rgba(0,0,0,0.2);
      color: #fff;
      font-size: 14px;
      line-height: 1.8;
      border: 1px solid rgba(255,255,255,0.05);
    }

    /* Floating Plates */
    .floating-plate {
      border-radius: 50%;
      object-fit: cover;
      position: absolute;
      z-index: 20;
      box-shadow: 0 30px 60px rgba(0,0,0,0.5);
    }

    .section-about .floating-plate { 
      width: 280px; height: 280px; 
      top: 50px; right: -90px; 
    }
    .section-menu .floating-plate { 
      width: 300px; height: 300px; 
      top: 100px; left: -140px; 
    }
    .section-special .floating-plate { 
      width: 200px; height: 200px; 
      top: 20px; right: 20px; 
    }
    .section-book .floating-plate { 
      width: 240px; height: 240px; 
      bottom: -40px; left: -80px; 
    }

    /* Menu List Formatting */
    .filter-form {
      margin-bottom: 30px;
      display: flex;
      justify-content: flex-end;
    }
    .filter-form select {
      background: transparent;
      border: 1px solid rgba(255,255,255,0.3);
      color: #fff;
      padding: 5px 10px;
      font-size: 11px;
      text-transform: uppercase;
      border-radius: 0;
      outline: none;
    }
    .filter-form select option {
      background: #3b4055;
    }

    .menu-item-row {
      display: flex;
      justify-content: space-between;
      align-items: baseline;
      margin-bottom: 2px;
      font-family: 'Inter', sans-serif;
      font-size: 11px;
      text-transform: uppercase;
    }
    .menu-item-name {
      font-weight: 500;
      letter-spacing: 1px;
      white-space: nowrap;
    }
    .menu-item-dots {
      flex-grow: 1;
      border-bottom: 1px solid rgba(255,255,255,0.2);
      margin: 0 15px;
      position: relative;
      top: -4px;
    }
    .menu-item-price {
      font-weight: 500;
      white-space: nowrap;
    }
    .menu-item-desc {
      font-size: 9px;
      color: rgba(255,255,255,0.5);
      margin-bottom: 20px;
      font-style: italic;
    }

    /* Form in BOOK section */
    .book-form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
    }
    .book-form input, .book-form select {
      background: #fff;
      border: none;
      padding: 10px 15px;
      font-size: 11px;
      font-family: 'Inter', sans-serif;
      color: #333;
    }
    .book-form .full-width {
      grid-column: 1 / -1;
      display: flex;
      justify-content: center;
      margin-top: 10px;
    }
    .book-form button {
      background: #fff;
      border: none;
      padding: 10px 40px;
      font-size: 11px;
      font-weight: bold;
      text-transform: uppercase;
      letter-spacing: 2px;
      color: #333;
      cursor: pointer;
    }

    /* Custom Bottom Bar */
    .custom-bottom-bar {
      background-color: #3b4055;
      width: 550px;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
      z-index: 10;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    .custom-bottom-bar a {
      color: #fff;
      font-family: 'Inter', sans-serif;
      font-weight: 300;
      font-size: 16px;
      letter-spacing: 2px;
      text-transform: uppercase;
      text-decoration: none;
      transition: color 0.3s;
    }
    .custom-bottom-bar a:hover {
      color: #d0a866;
    }

    @media (max-width: 992px) {
      .menu-pillar { display: none; }
      .section-about, .section-menu, .section-special, .section-book {
        align-items: center;
        padding: 0 20px;
      }
      .massive-title {
        position: relative;
        top: 0 !important;
        left: 0 !important;
        font-size: 50px;
        letter-spacing: 15px;
        text-align: center;
        margin-bottom: 20px;
      }
      .menu-card { width: 100%; max-width: 500px; padding: 30px; }
      .floating-plate { position: relative; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important; margin: -50px auto 20px auto; display: block; }
      .custom-bottom-bar { width: 100%; max-width: 500px; flex-wrap: wrap; gap: 15px; justify-content: center; }
    }
  </style>
</head>
<body>

  <!-- ======= Header ======= -->
  <?php readheader(); ?>

  <div class="menu-layout-wrapper">
    
    <!-- Central Pillar -->
    <div class="menu-pillar">
      <div class="pillar-holes">
        <div class="pillar-hole"></div>
        <div class="pillar-hole"></div>
      </div>
    </div>

    <!-- ABOUT SECTION -->
    <div class="menu-section section-about">
      <div class="massive-title">A B O U T</div>
      <div class="menu-card">
        <p>Each property celebrates the unique essence of its destination to give you a personalized experience with a thoughtfulness you'll find only in the best hotels and cafes of the world.</p>
        <p>We pride ourselves on culinary excellence and an unforgettable atmosphere.</p>
      </div>
      <img src="assets/img/menu_plates/plate_salad.png" class="floating-plate" alt="Salad">
    </div>

    <!-- MENU SECTION -->
    <div class="menu-section section-menu">
      <div class="massive-title">M E N U</div>
      <div class="menu-card">
        
        <!-- Filter -->
        <form class="filter-form" method="POST" action="">
          <select id="country" name="country" onchange="this.form.submit()">
            <option value="">All Regions</option>
            <?php
            $country_sql = "SELECT DISTINCT country FROM food_menu";
            $country_result = $conn->query($country_sql);
            if ($country_result->num_rows > 0) {
              while($country_row = $country_result->fetch_assoc()) {
                $selected = (isset($_POST['country']) && $_POST['country'] == $country_row['country']) ? 'selected' : '';
                echo "<option value='".$country_row['country']."' $selected>".$country_row['country']."</option>";
              }
            }
            ?>
          </select>
        </form>

        <!-- Dynamic Menu Items -->
        <div class="menu-items-list">
          <?php
          $country_filter = isset($_POST['country']) ? $_POST['country'] : '';
          $sql = "SELECT name, country, description, price FROM food_menu";
          if ($country_filter != '') {
            $sql .= " WHERE country = '$country_filter'";
          }
          $sql .= " ORDER BY name LIMIT 6"; // Limiting to keep layout clean, adjust as needed
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "<div class='menu-item-row'>";
              echo "  <div class='menu-item-name'>{$row['name']}</div>";
              echo "  <div class='menu-item-dots'></div>";
              echo "  <div class='menu-item-price'>Rs. {$row['price']}</div>";
              echo "</div>";
              echo "<div class='menu-item-desc'>{$row['description']}</div>";
            }
          } else {
            echo "<div>No menu items found.</div>";
          }
          ?>
        </div>

      </div>
      <img src="assets/img/menu_plates/plate_main.png" class="floating-plate" alt="Main Dish">
    </div>

    <!-- SPECIAL SECTION -->
    <div class="menu-section section-special">
      <div class="massive-title">S P E C I A L</div>
      <div class="menu-card">
        <p>These special offers cannot be availed of in conjunction with any other ongoing promotions, offers or schemes, nor are they applicable during any special events or festivals. Prior table reservation is recommended.</p>
      </div>
      <img src="assets/img/menu_plates/plate_soup.png" class="floating-plate" alt="Soup">
    </div>

    <!-- BOOK SECTION -->
    <div class="menu-section section-book">
      <div class="massive-title">B O O K</div>
      <div class="menu-card">
        <form class="book-form" action="parking.php">
          <input type="text" placeholder="Name">
          <input type="text" placeholder="Phone">
          <input type="email" placeholder="E-mail">
          <input type="date">
          <div class="full-width">
            <button type="submit">BOOK</button>
          </div>
        </form>
      </div>
      <img src="assets/img/menu_plates/plate_dessert.png" class="floating-plate" alt="Dessert">
    </div>

    <!-- BOTTOM BAR -->
    <div class="custom-bottom-bar">
      <a href="#about">ABOUT</a>
      <a href="#menu">MENU</a>
      <a href="#special">SPECIAL</a>
      <a href="parking.php">BOOK</a>
    </div>

  </div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>
