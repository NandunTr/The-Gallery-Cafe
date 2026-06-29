<?php
// Disable mysqli strict exceptions to handle missing tables gracefully
mysqli_report(MYSQLI_REPORT_OFF); 

// Database connection settings
$servername = "localhost";
$username = "root";
$password = ""; // Update with your database password
$dbname = "gallery_cafe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch basic stats
$total_revenue = 0;
$total_orders = 0;

$rev_sql = "SELECT SUM(total_price) as sum, COUNT(*) as count FROM orders";
$rev_result = $conn->query($rev_sql);
if ($rev_result && $rev_result->num_rows > 0) {
    $row = $rev_result->fetch_assoc();
    $total_revenue = $row['sum'] ? $row['sum'] : 0;
    $total_orders = $row['count'] ? $row['count'] : 0;
}

$tables = ['orders', 'beverages', 'food_menu', 'parking_spaces', 'reservations', 'staff'];
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'dashboard';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Cafe - Admin Dashboard</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --bg-color: #f0f2f5;
            --surface-color: #ffffff;
            --primary-green: #108c5a;
            --text-main: #1c1c1c;
            --text-muted: #8e8e93;
            --border-radius-lg: 24px;
            --border-radius-md: 16px;
            --border-radius-sm: 8px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            color: var(--text-main);
        }

        /* Sidebar */
        .sidebar {
            width: 80px;
            background-color: var(--surface-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.03);
            border-right: 1px solid rgba(0,0,0,0.05);
            z-index: 100;
        }
        .sidebar .logo {
            width: 45px;
            height: 45px;
            background-color: var(--primary-green);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 50px;
        }
        .sidebar .nav-item {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            margin-bottom: 20px;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .sidebar .nav-item:hover, .sidebar .nav-item.active {
            background-color: #e6f4ef;
            color: var(--primary-green);
        }

        /* Main Content */
        .main-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            padding: 20px 40px;
            overflow-x: hidden;
        }

        /* Topbar */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--surface-color);
            padding: 15px 30px;
            border-radius: var(--border-radius-lg);
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            margin-bottom: 40px;
        }
        .top-tabs {
            display: flex;
            gap: 30px;
        }
        .top-tabs a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 14px;
            transition: color 0.3s;
        }
        .top-tabs a.active, .top-tabs a:hover {
            color: var(--text-main);
        }
        .top-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .top-actions i {
            font-size: 18px;
            color: var(--text-main);
            cursor: pointer;
        }
        .avatar {
            width: 35px;
            height: 35px;
            background-color: #ddd;
            border-radius: 50%;
            overflow: hidden;
        }
        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Header Section */
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .welcome-text {
            font-size: 32px;
            font-weight: 400;
            letter-spacing: -0.5px;
        }
        .welcome-text span {
            color: var(--text-muted);
        }
        .header-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        .date-badge {
            background-color: var(--surface-color);
            padding: 10px 20px;
            border-radius: var(--border-radius-md);
            font-size: 13px;
            font-weight: 500;
            color: var(--text-main);
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-add {
            background-color: var(--surface-color);
            color: var(--text-main);
            border: none;
            padding: 10px 20px;
            border-radius: var(--border-radius-md);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-add:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transform: translateY(-1px);
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }
        .left-col {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }
        
        .top-cards-row {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 20px;
        }

        /* Cards */
        .card {
            background-color: var(--surface-color);
            border-radius: var(--border-radius-lg);
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.02);
            position: relative;
        }
        .card-green {
            background-color: var(--primary-green);
            color: white;
            box-shadow: 0 10px 30px rgba(16, 140, 90, 0.2);
        }
        
        .card-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 5px;
        }
        .card-green .card-title {
            color: rgba(255,255,255,0.8);
        }
        .card-subtitle {
            font-size: 11px;
            color: #b0b0b0;
            margin-bottom: 25px;
        }
        .card-green .card-subtitle {
            color: rgba(255,255,255,0.6);
        }
        
        .card-value {
            font-size: 36px;
            font-weight: 500;
            letter-spacing: -1px;
            margin-bottom: 10px;
        }
        
        /* Bar Chart Mock */
        .chart-container {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            height: 150px;
            margin-top: 30px;
            gap: 15px;
        }
        .chart-bar-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            flex: 1;
        }
        .chart-bar {
            width: 100%;
            background: repeating-linear-gradient(
              45deg,
              #e6f4ef,
              #e6f4ef 5px,
              #d1e9e0 5px,
              #d1e9e0 10px
            );
            border-radius: 20px;
            transition: all 0.3s;
        }
        .chart-bar.active {
            background: var(--primary-green);
        }
        .chart-label {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* History Table */
        .history-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .history-table th {
            text-align: left;
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 500;
            padding-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
        }
        .history-table td {
            padding: 15px 0;
            font-size: 14px;
            font-weight: 500;
            border-bottom: 1px solid #f9f9f9;
        }
        .history-table tr:last-child td {
            border-bottom: none;
        }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--text-main);
        }
        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--primary-green);
        }

        /* Raw DB Table display */
        .db-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .db-table th, .db-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }
        .db-table th {
            background-color: #fafafa;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 13px;
        }
        .db-table tr:hover {
            background-color: #f9f9f9;
        }
        .no-results {
            text-align: center;
            color: var(--text-muted);
            padding: 40px;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">Q</div>
        <a href="admin.php?tab=dashboard" class="nav-item <?= $active_tab == 'dashboard' ? 'active' : '' ?>"><i class="bi bi-grid-fill"></i></a>
        <a href="admin.php?tab=orders" class="nav-item <?= $active_tab == 'orders' ? 'active' : '' ?>"><i class="bi bi-receipt"></i></a>
        <a href="admin.php?tab=reservations" class="nav-item <?= $active_tab == 'reservations' ? 'active' : '' ?>"><i class="bi bi-calendar-check"></i></a>
        <a href="admin.php?tab=food_menu" class="nav-item <?= $active_tab == 'food_menu' ? 'active' : '' ?>"><i class="bi bi-cup-hot"></i></a>
        <a href="admin.php?tab=beverages" class="nav-item <?= $active_tab == 'beverages' ? 'active' : '' ?>"><i class="bi bi-cup-straw"></i></a>
        <a href="admin.php?tab=staff" class="nav-item <?= $active_tab == 'staff' ? 'active' : '' ?>"><i class="bi bi-person-badge"></i></a>
        <a href="Home.php" class="nav-item" style="margin-top: auto;"><i class="bi bi-box-arrow-left"></i></a>
    </div>

    <!-- Main Content -->
    <div class="main-wrapper">
        
        <!-- Top Navigation -->
        <div class="topbar">
            <div class="top-tabs">
                <a href="admin.php?tab=dashboard" class="<?= $active_tab == 'dashboard' ? 'active' : '' ?>">Dashboard</a>
                <a href="admin.php?tab=orders" class="<?= $active_tab == 'orders' ? 'active' : '' ?>">Orders</a>
                <a href="admin.php?tab=reservations" class="<?= $active_tab == 'reservations' ? 'active' : '' ?>">Reservations</a>
                <a href="admin.php?tab=food_menu" class="<?= $active_tab == 'food_menu' ? 'active' : '' ?>">Menu</a>
                <a href="admin.php?tab=beverages" class="<?= $active_tab == 'beverages' ? 'active' : '' ?>">Beverages</a>
                <a href="admin.php?tab=staff" class="<?= $active_tab == 'staff' ? 'active' : '' ?>">Staff</a>
            </div>
            <div class="top-actions">
                <i class="bi bi-search"></i>
                <i class="bi bi-bell"></i>
                <div class="avatar">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=108c5a&color=fff" alt="Admin">
                </div>
            </div>
        </div>

        <?php if ($active_tab == 'dashboard'): ?>
        
        <!-- Dashboard View -->
        <div class="header-section">
            <div class="welcome-text">Welcome Back, <span>Admin</span></div>
            
            <div class="header-actions">
                <div class="date-badge">
                    <i class="bi bi-calendar4"></i> <?= date('d M, Y') ?>
                </div>
                <a href="add items.php" class="btn-add"><i class="bi bi-plus"></i> Add Food</a>
                <a href="add beveragers.php" class="btn-add"><i class="bi bi-plus"></i> Add Beverage</a>
            </div>
        </div>

        <div class="dashboard-grid">
            
            <!-- Left Column -->
            <div class="left-col">
                
                <div class="top-cards-row">
                    <!-- Revenue Card -->
                    <div class="card card-green">
                        <div class="card-title">Total Revenue</div>
                        <div class="card-subtitle">All time revenue sum</div>
                        <div style="margin-top: 30px; font-size: 14px; opacity: 0.8">CAFE INCOME</div>
                        <div class="card-value">Rs. <?= number_format($total_revenue, 2) ?></div>
                        <div style="font-size: 12px; opacity: 0.8">Total Orders: <?= $total_orders ?></div>
                    </div>

                    <!-- Engagement Chart Card -->
                    <div class="card">
                        <div style="display: flex; justify-content: space-between; align-items: center">
                            <div>
                                <div class="card-title" style="color: var(--text-main)">Order Volume</div>
                                <div class="card-subtitle" style="margin:0">Weekly</div>
                            </div>
                            <div style="background: var(--primary-green); color: white; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: bold">+12.8%</div>
                        </div>
                        
                        <!-- Mock CSS Chart -->
                        <div class="chart-container">
                            <div class="chart-bar-wrapper"><div class="chart-bar" style="height: 30%"></div><div class="chart-label">JAN</div></div>
                            <div class="chart-bar-wrapper"><div class="chart-bar" style="height: 60%"></div><div class="chart-label">FEB</div></div>
                            <div class="chart-bar-wrapper"><div class="chart-bar" style="height: 40%"></div><div class="chart-label">MAR</div></div>
                            <div class="chart-bar-wrapper"><div class="chart-bar active" style="height: 100%"></div><div class="chart-label">APR</div></div>
                            <div class="chart-bar-wrapper"><div class="chart-bar" style="height: 70%"></div><div class="chart-label">MAY</div></div>
                            <div class="chart-bar-wrapper"><div class="chart-bar" style="height: 50%"></div><div class="chart-label">JUN</div></div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders History -->
                <div class="card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div>
                            <div class="card-title" style="color: var(--text-main); font-size: 16px;">Recent Orders</div>
                            <div class="card-subtitle" style="margin:0">Latest order history</div>
                        </div>
                        <a href="admin.php?tab=orders" style="color: var(--text-muted); text-decoration: none;"><i class="bi bi-box-arrow-up-right"></i></a>
                    </div>
                    
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $hist_sql = "SELECT * FROM orders ORDER BY id DESC LIMIT 5";
                            // Fallback if 'id' doesn't exist
                            $hist_result = $conn->query($hist_sql);
                            if (!$hist_result) {
                                // If 'id' column fails, just select without order
                                $hist_result = $conn->query("SELECT * FROM orders LIMIT 5");
                            }

                            if ($hist_result && $hist_result->num_rows > 0) {
                                while($row = $hist_result->fetch_assoc()) {
                                    $name = isset($row['name']) ? $row['name'] : 'Customer';
                                    $email = isset($row['email']) ? $row['email'] : '-';
                                    $phone = isset($row['phone']) ? $row['phone'] : '-';
                                    $amount = isset($row['total_price']) ? $row['total_price'] : '0';
                                    
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($name) . "</td>";
                                    echo "<td style='color: var(--text-muted)'>" . htmlspecialchars($email) . "</td>";
                                    echo "<td style='color: var(--text-muted)'>" . htmlspecialchars($phone) . "</td>";
                                    echo "<td><div class='status-badge'><div class='status-dot'></div> Successful</div></td>";
                                    echo "<td>Rs. " . number_format((float)$amount, 2) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='no-results'>No recent orders found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
            
            <!-- Right Column -->
            <div class="right-col">
                <div class="card" style="margin-bottom: 30px;">
                    <div class="card-title" style="color: var(--text-main)">Staff & Admin</div>
                    <div class="card-subtitle">Manage system users</div>
                    
                    <?php
                    $staff_count = 0;
                    $sc_res = $conn->query("SELECT COUNT(*) as c FROM staff");
                    if($sc_res) { $staff_row = $sc_res->fetch_assoc(); $staff_count = $staff_row['c']; }
                    ?>
                    <div class="card-value" style="font-size: 28px; margin-top:20px;"><?= $staff_count ?> Users</div>
                    
                    <div style="margin-top: 30px; display: flex; gap: 10px;">
                        <a href="add_staff_acc.php" class="btn-add" style="background: var(--primary-green); color: white; flex:1; justify-content:center">Add Staff</a>
                        <a href="add_admin_acc.php" class="btn-add" style="border: 1px solid #ddd; flex:1; justify-content:center; box-shadow:none">Add Admin</a>
                    </div>
                </div>
            </div>
            
        </div>
        
        <?php else: ?>
        
        <!-- Table View -->
        <div class="header-section">
            <div class="welcome-text"><?= ucfirst(str_replace('_', ' ', $active_tab)) ?> <span>Database</span></div>
        </div>

        <div class="card" style="overflow-x: auto;">
            <?php
            $sql = "SELECT * FROM $active_tab";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                echo "<table class='db-table'><thead><tr>";
                $fields = $result->fetch_fields();
                foreach ($fields as $field) {
                    echo "<th>" . htmlspecialchars($field->name) . "</th>";
                }
                echo "</tr></thead><tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<div class='no-results'>No data found in this table.</div>";
            }
            ?>
        </div>
        
        <?php endif; ?>

    </div>

</body>
</html>
<?php $conn->close(); ?>
