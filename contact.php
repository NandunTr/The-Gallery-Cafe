<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Gallery Cafe</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        /* Nav Override */
        header {
            background-color: #35322d !important; /* Ensure navbar is visible */
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            background-image: url('assets/img/cafe_contact_hero.png');
            background-size: cover;
            background-position: center 30%;
            height: 60vh;
            min-height: 450px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .hero-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(45, 50, 62, 0.75); /* Moody slate blue overlay */
        }
        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            padding: 0 20px;
            max-width: 800px;
        }
        .hero-content h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 48px;
            font-weight: 700;
            color: #e85a3a; /* Exact Orange */
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .divider-dots {
            font-size: 24px;
            color: rgba(255,255,255,0.5);
            letter-spacing: 5px;
            margin-bottom: 25px;
        }
        .hero-content p {
            font-size: 18px;
            font-weight: 300;
            line-height: 1.6;
        }

        /* Contact Info Section */
        .info-section {
            background: #ffffff;
            padding: 80px 0 50px 0;
        }
        .info-box {
            text-align: center;
            padding: 30px;
            height: 100%;
        }
        .info-box.middle-box {
            border-left: 1px solid #f0f0f0;
            border-right: 1px solid #f0f0f0;
        }
        .info-icon {
            font-size: 36px;
            color: #e85a3a; /* Orange */
            margin-bottom: 20px;
        }
        .info-box h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #333;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        .info-box p {
            color: #a0a0a0;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 20px;
        }
        .info-detail {
            color: #e85a3a;
            font-weight: 600;
            font-size: 15px;
        }

        /* Contact Form Section */
        .form-section {
            padding: 20px 0 100px 0;
            background-color: #ffffff;
        }
        .contact-form {
            max-width: 800px;
            margin: 0 auto;
        }
        .contact-form .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            padding: 12px 15px;
            font-size: 14px;
            box-shadow: none;
            transition: border-color 0.3s ease;
        }
        .contact-form .form-control:focus {
            border-color: #e85a3a;
            box-shadow: none;
        }
        .contact-form textarea.form-control {
            min-height: 150px;
        }
        .submit-btn {
            background-color: #e85a3a;
            color: white;
            border: none;
            padding: 12px 40px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }
        .submit-btn:hover {
            background-color: #d1492b;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .info-box.middle-box {
                border-left: none;
                border-right: none;
                border-top: 1px solid #f0f0f0;
                border-bottom: 1px solid #f0f0f0;
            }
        }
    </style>
</head>
<body>

    <!-- Header Include -->
    <?php 
    include 'Header.php'; 
    readheader();
    ?>

    <!-- Hero Banner -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Contact Us</h1>
            <div class="divider-dots">&bull;&bull;&bull;&bull;&bull;&bull;</div>
            <p>We'd love to hear from you. Drop by for a cup of coffee or<br>leave us a message and we'll be in touch shortly.</p>
        </div>
    </section>

    <!-- 3-Column Info -->
    <section class="info-section">
        <div class="container">
            <div class="row no-gutters">
                <!-- Box 1 -->
                <div class="col-md-4">
                    <div class="info-box">
                        <i class="bi bi-house-door info-icon"></i>
                        <h3>Visit Us</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit duis</p>
                        <div class="info-detail">2 Alfred House Rd, Colombo, LK</div>
                    </div>
                </div>
                <!-- Box 2 -->
                <div class="col-md-4">
                    <div class="info-box middle-box">
                        <i class="bi bi-telephone info-icon"></i>
                        <h3>Call Us</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit duis</p>
                        <div class="info-detail">+94 (0) 71 281-9129</div>
                    </div>
                </div>
                <!-- Box 3 -->
                <div class="col-md-4">
                    <div class="info-box">
                        <i class="bi bi-envelope info-icon"></i>
                        <h3>Contact Us</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit duis</p>
                        <div class="info-detail">gallerycafe@gmail.com</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="form-section">
        <div class="container">
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "gallery_cafe";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                if (!$conn->connect_error) {
                    $name = $conn->real_escape_string($_POST['name']);
                    $email = $conn->real_escape_string($_POST['email']);
                    $subject = $conn->real_escape_string($_POST['subject']);
                    $message = $conn->real_escape_string($_POST['message']);

                    $sql = "INSERT INTO contact_form (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

                    if ($conn->query($sql) === TRUE) {
                        echo '<div class="alert alert-success" style="max-width:800px; margin: 0 auto 30px auto;">Your message has been sent successfully. We will be in touch!</div>';
                    } else {
                        echo '<div class="alert alert-danger" style="max-width:800px; margin: 0 auto 30px auto;">Error saving message. Please try again later.</div>';
                    }
                    $conn->close();
                }
            }
            ?>

            <div class="contact-form">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                    </div>
                    <div class="form-group mt-3">
                        <textarea class="form-control" name="message" placeholder="Message" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="submit-btn">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer Include -->
    <?php 
    include 'Footer.php';
    readfooter(); 
    ?>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
