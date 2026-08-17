<?php
/**
 * SHIFAURA - Global Footer Component
 */
?>
    <!-- Footer Section -->
    <footer>
        <div class="container footer-inner">
            <div class="footer-top">
                <!-- Column 1: Brand Info -->
                <div class="footer-brand">
                    <a href="index.php" class="logo-img-link" style="display: inline-block; margin-bottom: 0.5rem;">
                        <img src="assets/images/logo.png" alt="SHIFAURA by Dietitian Shifana.I" style="height: 58px; width: auto; background: rgba(255,255,255,0.9); padding: 6px 12px; border-radius: var(--radius-sm); display: block;">
                    </a>
                    <p>Evidence-based nutrition and holistic wellness, personalized to your body, lifestyle, and health goals.</p>
                    <div style="display: flex; flex-direction: column; gap: 0.4rem; color: var(--gold); font-size: 0.85rem; font-weight: 500; margin-top: 0.5rem;">
                        <span>📍 Nila Complex, Near Dmart, Podanur, Coimbatore - 641023</span>
                        <span>Dietitian Shifana.I (M.Sc. Food &amp; Nutrition) &bull; 📸 @dietitianshifana</span>
                    </div>
                </div>

                <!-- Column 2: Navigation Links -->
                <div class="footer-col">
                    <h4>Navigate</h4>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <!-- <li><a href="about.php">Meet Shifana.I</a></li> -->
                        <!-- <li><a href="services.php">Diet Services</a></li> -->
                        <!-- <li><a href="approach.php">Wellness Pillars</a></li> -->
                        <!-- <li><a href="resources.php">Resources</a></li> -->
                    </ul>
                </div>

                <!-- Column 3: Legal & Support -->
                <div class="footer-col">
                    <h4>Support</h4>
                    <ul class="footer-links">
                        <li><a href="index.php#book-consultation">Consultation Booking</a></li>
                        <li><a href="admin/login.php">Practitioner Dashboard</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Contact Office</a></li>
                    </ul>
                </div>

                <!-- Column 4: Newsletter -->
                <div class="footer-col footer-newsletter">
                    <h4>Stay Inspired</h4>
                    <p>Subscribe to receive simple, practical, and sustainable wellness tips directly in your inbox.</p>
                    <form class="newsletter-form" onsubmit="event.preventDefault(); alert('Thank you for subscribing to SHIFAURA newsletters!'); this.reset();">
                        <input type="email" placeholder="Your Email Address" required aria-label="Email for Newsletter">
                        <button type="submit" aria-label="Subscribe Button">
                            <i data-feather="chevron-right"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Footer Bottom Line -->
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved. Developed around evidence-based science.</p>
                <p>Designed with Care for Sustainable Health</p>
            </div>
        </div>
    <!-- Mobile Sticky Quick Action Bar (Call & WhatsApp) -->
    <div class="mobile-sticky-bar">
        <a href="tel:+916381757067" class="mobile-sticky-btn mobile-call-btn">
            <i data-feather="phone" style="width: 16px; height: 16px;"></i> Call Clinic
        </a>
        <a href="https://wa.me/916381757067?text=Hello%20Dietitian%20Shifana.I,%20I%20would%20like%20to%20book%20a%20consultation." target="_blank" rel="noopener noreferrer" class="mobile-sticky-btn mobile-wa-btn">
            <i data-feather="message-circle" style="width: 16px; height: 16px;"></i> WhatsApp Us
        </a>
    <!-- Scroll To Top Button -->
    <button id="scrollToTopBtn" class="scroll-to-top-btn" aria-label="Scroll to top of page">
        <i data-feather="arrow-up" style="width: 22px; height: 22px; color: var(--gold);"></i>
    </button>

    <!-- Feather Icons Render Script -->
    <script>
        feather.replace();
    </script>
    
    <!-- Main JavaScript Logic -->
    <script src="assets/js/main.js"></script>
</body>
</html>
