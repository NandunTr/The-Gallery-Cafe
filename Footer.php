<?php
function readfooter(){
?>
<style>
  /* ── Modern Footer Styles ── */
  .modern-footer-wrapper {
    background-color: #f8f9fa; /* Light background for the area containing the footer */
    padding: 40px 20px;
    font-family: 'Inter', 'Helvetica Neue', Helvetica, sans-serif;
  }

  .modern-footer {
    max-width: 1200px;
    margin: 0 auto;
    background-color: #ffffff;
    color: #333333;
    padding: 60px 50px 30px;
    border-radius: 24px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03);
    border: 1px solid #eaeaea;
  }

  .modern-footer-top {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 40px;
    margin-bottom: 60px;
  }

  .modern-footer-brand {
    max-width: 380px;
  }

  .modern-footer-brand h3 {
    font-size: 22px;
    font-weight: 700;
    color: #111;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: 'Poppins', sans-serif; /* Keep a bit of the original vibe */
  }

  .modern-footer-brand p {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
    margin-bottom: 25px;
  }

  .modern-footer-socials {
    display: flex;
    gap: 16px;
  }

  .modern-footer-socials a {
    color: #111;
    font-size: 22px;
    transition: color 0.2s ease, transform 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .modern-footer-socials a:hover {
    color: #666;
    transform: translateY(-2px);
  }

  .modern-footer-links-wrapper {
    display: flex;
    gap: 80px;
    flex-wrap: wrap;
  }

  .modern-footer-col h4 {
    font-size: 15px;
    font-weight: 600;
    color: #111;
    margin-bottom: 20px;
    font-family: 'Poppins', sans-serif;
  }

  .modern-footer-col ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 14px;
  }

  .modern-footer-col ul li a {
    color: #666;
    font-size: 14px;
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .modern-footer-col ul li a:hover {
    color: #111;
  }

  .modern-footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 30px;
    border-top: 1px solid #eaeaea;
    flex-wrap: wrap;
    gap: 20px;
  }

  .modern-footer-bottom p {
    font-size: 13px;
    color: #666;
    margin: 0;
  }

  .modern-footer-legal {
    display: flex;
    gap: 24px;
  }

  .modern-footer-legal a {
    font-size: 13px;
    color: #666;
    text-decoration: none;
    position: relative;
  }
  
  .modern-footer-legal a::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 1px;
    background-color: #666;
    transition: opacity 0.2s;
  }

  .modern-footer-legal a:hover {
    color: #111;
  }
  
  .modern-footer-legal a:hover::after {
    background-color: #111;
  }

  /* Responsive Design */
  @media (max-width: 992px) {
    .modern-footer-links-wrapper {
      gap: 50px;
    }
  }

  @media (max-width: 768px) {
    .modern-footer-wrapper {
      padding: 20px 15px;
    }
    
    .modern-footer {
      padding: 40px 30px 25px;
    }

    .modern-footer-top {
      flex-direction: column;
      gap: 40px;
    }

    .modern-footer-links-wrapper {
      flex-direction: column;
      gap: 30px;
    }
    
    .modern-footer-bottom {
      flex-direction: column;
      align-items: flex-start;
    }
  }
</style>

<div class="modern-footer-wrapper">
  <footer class="modern-footer">
    
    <div class="modern-footer-top">
      
      <!-- Brand & Socials -->
      <div class="modern-footer-brand">
        <h3>
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-coffee"><path d="M10 2v2"/><path d="M14 2v2"/><path d="M16 8a1 1 0 0 1 1 1v8a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V9a1 1 0 0 1 1-1h14a4 4 0 1 1 0 8h-1"/><path d="M6 2v2"/></svg>
          The Gallery Café
        </h3>
        <p>The Gallery Café empowers you to experience exquisite culinary offerings and artistic ambiance — making every meal a memorable experience to share, understand, and act on.</p>
        
        <div class="modern-footer-socials">
          <a href="#" aria-label="Twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" aria-label="Instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" aria-label="LinkedIn"><i class="bx bxl-linkedin"></i></a>
          <a href="#" aria-label="GitHub"><i class="bx bxl-github"></i></a>
        </div>
      </div>

      <!-- Navigation Links -->
      <div class="modern-footer-links-wrapper">
        
        <div class="modern-footer-col">
          <h4>Menu</h4>
          <ul>
            <li><a href="menu foods.php">Foods</a></li>
            <li><a href="menu beveragers.php">Beverages</a></li>
            <li><a href="#">Desserts</a></li>
            <li><a href="#">Specials</a></li>
          </ul>
        </div>

        <div class="modern-footer-col">
          <h4>Resources</h4>
          <ul>
            <li><a href="book_table.php">Reservations</a></li>
            <li><a href="parking.php">Parking</a></li>
            <li><a href="#">Private Events</a></li>
            <li><a href="#">Support</a></li>
          </ul>
        </div>

        <div class="modern-footer-col">
          <h4>Company</h4>
          <ul>
            <li><a href="#about">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Partners</a></li>
          </ul>
        </div>

      </div>

    </div>

    <!-- Bottom Legal & Copyright -->
    <div class="modern-footer-bottom">
      <p>&copy; 2026 The Gallery Café. All rights reserved.</p>
      <div class="modern-footer-legal">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Cookies Settings</a>
      </div>
    </div>

  </footer>
</div>
<?php
}
?>
