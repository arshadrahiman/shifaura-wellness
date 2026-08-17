<?php
/**
 * SHIFAURA - Homepage (Index)
 */
require_once __DIR__ . '/db/connection.php';

$booking_success = false;
$booking_error = '';

// Handle Consultation Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'book_consultation') {
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS));
    $date = trim(filter_input(INPUT_POST, 'preferred_date', FILTER_SANITIZE_SPECIAL_CHARS));
    $time = trim(filter_input(INPUT_POST, 'preferred_time', FILTER_SANITIZE_SPECIAL_CHARS));
    $goal = trim(filter_input(INPUT_POST, 'health_goal', FILTER_SANITIZE_SPECIAL_CHARS));
    $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS));

    if (!empty($name) && !empty($email) && !empty($phone) && !empty($date) && !empty($time) && !empty($goal)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO bookings (name, email, phone, preferred_date, preferred_time, health_goal, message) VALUES (:name, :email, :phone, :date, :time, :goal, :message)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':date' => $date,
                ':time' => $time,
                ':goal' => $goal,
                ':message' => $message
            ]);
            $booking_success = true;

            // Send Email Notification to Dietitian Shifana.I
            $to = "info@dietitianshifana.com";
            $subject = "New Consultation Request: " . $name . " (" . $goal . ")";
            
            $headers = "From: SHIFAURA Wellness <noreply@dietitianshifana.com>\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            $html_message = !empty($message) ? nl2br(htmlspecialchars($message)) : 'None provided';
            $mail_body = "
            <html>
            <head><title>New Consultation Request</title></head>
            <body style='font-family: Arial, sans-serif; background-color: #FAF7F2; padding: 20px;'>
                <div style='background-color: #FFFFFF; border: 1px solid #DCD0B7; padding: 25px; border-radius: 8px; max-width: 600px; margin: 0 auto;'>
                    <h2 style='color: #1E3A2B; border-bottom: 2px solid #BCA374; padding-bottom: 10px; margin-top: 0;'>New SHIFAURA Consultation Request</h2>
                    <p style='margin: 8px 0;'><strong>Client Name:</strong> {$name}</p>
                    <p style='margin: 8px 0;'><strong>Email:</strong> <a href='mailto:{$email}'>{$email}</a></p>
                    <p style='margin: 8px 0;'><strong>Phone:</strong> <a href='tel:{$phone}'>{$phone}</a></p>
                    <p style='margin: 8px 0;'><strong>Primary Goal:</strong> {$goal}</p>
                    <p style='margin: 8px 0;'><strong>Preferred Date:</strong> {$date}</p>
                    <p style='margin: 8px 0;'><strong>Preferred Time:</strong> {$time}</p>
                    <div style='margin-top: 15px; padding: 12px; background-color: #F3ECE1; border-radius: 6px;'>
                        <strong>Message / Medical Context:</strong><br>{$html_message}
                    </div>
                    <hr style='border: none; border-top: 1px solid #E6DBC6; margin: 20px 0;'>
                    <p style='font-size: 12px; color: #5E6962;'>Sent automatically from your SHIFAURA Website booking form.</p>
                </div>
            </body>
            </html>
            ";

            @mail($to, $subject, $mail_body, $headers);
        } catch (PDOException $e) {
            $booking_error = 'Something went wrong. Please try again. Code: ' . $e->getCode();
        }
    } else {
        $booking_error = 'Please fill in all mandatory fields.';
    }
}

$page_title = 'Personalized Nutrition & Holistic Wellness';
$page_description = 'SHIFAURA by Dietitian Shifana.I. Personalized health plans for weight management, diabetes care, PMOS, thyroid, and fertility nutrition.';
include_once __DIR__ . '/includes/header.php';
?>

    <!-- 1. Hero Section -->
    <section class="hero-section">
        <div class="container hero-grid">
            <div class="hero-content">
                <h1>
                    <span class="brand-highlight">SHIFAURA</span>
                    Not another diet, a better way to live.
                </h1>
                <p class="hero-subtitle">
                    Evidence-based nutrition and holistic wellness, personalized to your body, lifestyle, and goals. 
                    Whether your goal is weight management, diabetes care, hormonal health, fertility, or simply feeling healthier, SHIFAURA helps you build sustainable habits that fit your life.
                </p>
                <div class="hero-buttons">
                    <a href="#book-consultation" class="btn btn-primary">Book A Consultation</a>
                    <!-- <a href="approach.php" class="btn btn-secondary">Explore Our Approach</a> -->
                </div>
                <div class="hero-trust-line">
                    <strong>7+ Years Experience</strong> &nbsp;|&nbsp; 
                    <strong>M.Sc. Food Science & Nutrition</strong> &nbsp;|&nbsp; 
                    <strong>Certified Diabetes Educator</strong>
                </div>
            </div>
            <div class="hero-image-container">
                <!-- SHIFAURA Wellness & Pillars Brand Card -->
                <div style="background: linear-gradient(145deg, var(--green-dark) 0%, #2A331F 100%); border-radius: var(--radius-lg); padding: 3rem 2rem; color: var(--sandal-light); border: 2px solid var(--gold); box-shadow: var(--shadow-lg); text-align: center;">
                    <img src="assets/images/logo.png" alt="SHIFAURA Logo" style="height: 60px; width: auto; background: rgba(255,255,255,0.95); padding: 8px 16px; border-radius: var(--radius-sm); margin-bottom: 2rem; display: inline-block;">
                    
                    <h3 style="font-family: 'Bodoni Moda', serif; font-style: italic; font-size: 1.85rem; color: var(--sandal-light); margin-bottom: 1.5rem;">Evidence-Based Holistic Care</h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 1rem; text-align: left;">
                        <div style="background: rgba(248, 235, 222, 0.08); padding: 1rem 1.25rem; border-radius: var(--radius-md); border-left: 3px solid var(--gold); display: flex; align-items: center; gap: 0.75rem;">
                            <span style="font-size: 1.5rem;">🥗</span>
                            <div>
                                <strong style="display: block; color: var(--sandal-light); font-size: 0.95rem;">Personalized Food Strategies</strong>
                                <span style="font-size: 0.8rem; color: #C2CBB2;">Tailored around your local kitchen and home meals</span>
                            </div>
                        </div>
                        <div style="background: rgba(248, 235, 222, 0.08); padding: 1rem 1.25rem; border-radius: var(--radius-md); border-left: 3px solid var(--gold); display: flex; align-items: center; gap: 0.75rem;">
                            <span style="font-size: 1.5rem;">🩸</span>
                            <div>
                                <strong style="display: block; color: var(--sandal-light); font-size: 0.95rem;">PMOS &amp; Diabetes Clinical Care</strong>
                                <span style="font-size: 0.8rem; color: #C2CBB2;">Metabolic recovery &amp; blood sugar balance</span>
                            </div>
                        </div>
                        <div style="background: rgba(248, 235, 222, 0.08); padding: 1rem 1.25rem; border-radius: var(--radius-md); border-left: 3px solid var(--gold); display: flex; align-items: center; gap: 0.75rem;">
                            <span style="font-size: 1.5rem;">💬</span>
                            <div>
                                <strong style="display: block; color: var(--sandal-light); font-size: 0.95rem;">Direct Guidance with Shifana.I</strong>
                                <span style="font-size: 0.8rem; color: #C2CBB2;">Continuous WhatsApp support &amp; 1-on-1 calls</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Trust Statement Section -->
    <section class="section-bg-alt" style="padding: 5rem 0;">
        <div class="container">
            <div class="trust-intro">
                <span class="badge" style="margin-bottom: 1rem;">Holistic Philosophy</span>
                <h3>Your Health Is More Than a Diet.</h3>
                <p>
                    At SHIFAURA, we look beyond calories and meal plans. We understand that lasting health is shaped by the way you eat, move, breathe, hydrate, sleep, think, and live. Our approach combines evidence-based nutrition with holistic lifestyle guidance to create a healthier way of living—one that is realistic, personalized, and sustainable.
                </p>
                <div class="trust-bullets">
                    <div class="trust-bullet">
                        <i data-feather="check-circle"></i>
                        <span>Personalized care</span>
                    </div>
                    <div class="trust-bullet">
                        <i data-feather="check-circle"></i>
                        <span>Practical guidance</span>
                    </div>
                    <div class="trust-bullet">
                        <i data-feather="check-circle"></i>
                        <span>Sustainable transformation</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8 Pillars Section -->
    <section>
        <div class="container">
            <div class="section-header center">
                <span class="tag">The Core Framework</span>
                <h2>8 Pillars of SHIFAURA Wellness</h2>
                <p>Holistic wellness starts with caring for the whole you. We integrate these elements into every health journey.</p>
            </div>
            
            <div class="pillars-grid">
                <!-- Pillar 1 -->
                <div class="pillar-card">
                    <span class="pillar-icon">🥗</span>
                    <h3>Nourish</h3>
                    <p>Nutrition tailored to support metabolic, cellular, and overall wellbeing.</p>
                </div>
                <!-- Pillar 2 -->
                <div class="pillar-card">
                    <span class="pillar-icon">🏃</span>
                    <h3>Move</h3>
                    <p>Physical activity integrated around your natural lifestyle and capability.</p>
                </div>
                <!-- Pillar 3 -->
                <div class="pillar-card">
                    <span class="pillar-icon">💧</span>
                    <h3>Hydrate</h3>
                    <p>Optimizing cellular functions through consistent, clean water habits.</p>
                </div>
                <!-- Pillar 4 -->
                <div class="pillar-card">
                    <span class="pillar-icon">🌬️</span>
                    <h3>Breathe</h3>
                    <p>Using breathing mechanics and quality air to manage stress and energy.</p>
                </div>
                <!-- Pillar 5 -->
                <div class="pillar-card">
                    <span class="pillar-icon">😴</span>
                    <h3>Restore</h3>
                    <p>Deep, circadian-aligned sleep protocols for hormonal recovery.</p>
                </div>
                <!-- Pillar 6 -->
                <div class="pillar-card">
                    <span class="pillar-icon">❤️</span>
                    <h3>Balance</h3>
                    <p>Nurturing emotional stability and mental stillness in a busy life.</p>
                </div>
                <!-- Pillar 7 -->
                <div class="pillar-card">
                    <span class="pillar-icon">✨</span>
                    <h3>Connect</h3>
                    <p>Fostering spiritual awareness and inner alignment for core power.</p>
                </div>
                <!-- Pillar 8 -->
                <div class="pillar-card">
                    <span class="pillar-icon">🌱</span>
                    <h3>Reconnect</h3>
                    <p>Tuning into nature, sunlight, and clean grounding for cellular health.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Your Health Goals Section -->
    <section class="section-bg-alt">
        <div class="container">
            <div class="section-header">
                <span class="tag">What are you working toward?</span>
                <h2>Nutrition That Meets You Where You Are</h2>
                <p>Whether you're working toward a specific health goal or simply want to feel better in your body, your plan should be designed for you.</p>
            </div>

            <div class="goals-grid">
                <!-- Goal 1 -->
                <div class="goal-card">
                    <div class="goal-icon"><i data-feather="scale"></i></div>
                    <h3>Weight Management</h3>
                    <p>Personalized strategies for sustainable weight loss and healthy weight gain, avoiding starvation or crash trends.</p>
                    <a href="#packages" class="goal-link">Explore Plan <i data-feather="arrow-right"></i></a>
                </div>
                <!-- Goal 2 -->
                <div class="goal-card">
                    <div class="goal-icon"><i data-feather="activity"></i></div>
                    <h3>Diabetes Management</h3>
                    <p>Practical nutrition guidance to support better blood sugar management, insulin sensitivity, and healthier routines.</p>
                    <a href="#packages" class="goal-link">Explore Plan <i data-feather="arrow-right"></i></a>
                </div>
                <!-- Goal 3 -->
                <div class="goal-card">
                    <div class="goal-icon"><i data-feather="heart"></i></div>
                    <h3>PMOS & Hormonal Health</h3>
                    <p>Nutrition and lifestyle support designed around your individual hormonal, metabolic, and ovarian profile.</p>
                    <a href="#packages" class="goal-link">Explore Plan <i data-feather="arrow-right"></i></a>
                </div>
                <!-- Goal 4 -->
                <div class="goal-card">
                    <div class="goal-icon"><i data-feather="shield"></i></div>
                    <h3>Thyroid Health</h3>
                    <p>Personalized nutrition guidance supporting optimal metabolism, endocrine balance, and energy levels.</p>
                    <a href="#packages" class="goal-link">Explore Plan <i data-feather="arrow-right"></i></a>
                </div>
                <!-- Goal 5 -->
                <div class="goal-card">
                    <div class="goal-icon"><i data-feather="sparkles"></i></div>
                    <h3>Fertility Nutrition</h3>
                    <p>Nourishing your body, balancing key systems, and supporting healthy habits throughout your preconception journey.</p>
                    <a href="#packages" class="goal-link">Explore Plan <i data-feather="arrow-right"></i></a>
                </div>
                <!-- Goal 6 -->
                <div class="goal-card">
                    <div class="goal-icon"><i data-feather="sun"></i></div>
                    <h3>Holistic Wellness</h3>
                    <p>A whole-person approach bringing together customized food therapy, movement, sleep, and emotional wellbeing.</p>
                    <a href="#packages" class="goal-link">Explore Plan <i data-feather="arrow-right"></i></a>
                </div>
            </div>

            <!-- <div style="text-align: center; margin-top: 3.5rem;">
                <a href="services.php" class="btn btn-secondary">View All Services &rarr;</a>
            </div> -->
        </div>
    </section>

    <!-- 4. The SHIFAURA Difference -->
    <section>
        <div class="container">
            <div class="diff-grid">
                <div>
                    <div class="section-header">
                        <span class="tag">Our Method</span>
                        <h2>Not Another Diet.<br>A Better Way to Live.</h2>
                        <p>Most diets tell you what to eat. SHIFAURA helps you understand why, how, and what works for you. Our approach is built around four principles.</p>
                    </div>
                    <!-- <div style="margin-top: 2rem;">
                        <a href="approach.php" class="btn btn-primary">Learn About Our Method</a>
                    </div> -->
                </div>

                <div class="diff-steps">
                    <div class="diff-step">
                        <div class="diff-number">01</div>
                        <div class="diff-text">
                            <h3>Understand</h3>
                            <p>We deeply evaluate your unique body dynamics, daily schedule, metabolic parameters, lifestyle, challenges, and goals.</p>
                        </div>
                    </div>
                    <div class="diff-step">
                        <div class="diff-number">02</div>
                        <div class="diff-text">
                            <h3>Personalize</h3>
                            <p>We craft practical nutrition, hydration, activity, and sleep guides tailored entirely around your specific lifestyle.</p>
                        </div>
                    </div>
                    <div class="diff-step">
                        <div class="diff-number">03</div>
                        <div class="diff-text">
                            <h3>Nourish</h3>
                            <p>You learn how to feed your cells and balance your meals, achieving healing and satisfaction without starvation.</p>
                        </div>
                    </div>
                    <div class="diff-step">
                        <div class="diff-number">04</div>
                        <div class="diff-text">
                            <h3>Transform</h3>
                            <p>We help you cement these rituals, forming lasting, sustainable habits that support long-term wellness.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. About Shifana.I Profile Card -->
    <section class="section-bg-alt">
        <div class="container">
            <div class="about-widget-grid">
                <div class="about-widget-image" style="background: linear-gradient(135deg, var(--sandal-medium) 0%, var(--sandal-dark) 100%); border-radius: var(--radius-lg); padding: 3rem 2rem; border: 2px solid var(--gold); display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; box-shadow: var(--shadow-md);">
                    <img src="assets/images/logo.png" alt="SHIFAURA Logo" style="height: 64px; width: auto; background: rgba(255,255,255,0.95); padding: 8px 16px; border-radius: var(--radius-sm); margin-bottom: 2rem; display: block;">
                    
                    <h4 style="font-family: 'Bodoni Moda', serif; font-style: italic; font-size: 1.6rem; color: var(--green-dark); margin-bottom: 1.5rem;">Practitioner Credentials</h4>
                    
                    <div style="display: flex; flex-direction: column; gap: 0.85rem; width: 100%;">
                        <div style="background: var(--white); padding: 0.85rem 1rem; border-radius: var(--radius-md); font-size: 0.85rem; font-weight: 600; color: var(--green-dark); border: 1px solid var(--sandal-border);">🎓 M.Sc. Food Science &amp; Nutrition</div>
                        <div style="background: var(--white); padding: 0.85rem 1rem; border-radius: var(--radius-md); font-size: 0.85rem; font-weight: 600; color: var(--green-dark); border: 1px solid var(--sandal-border);">🩺 Certified Diabetes Educator (CDE)</div>
                        <div style="background: var(--white); padding: 0.85rem 1rem; border-radius: var(--radius-md); font-size: 0.85rem; font-weight: 600; color: var(--green-dark); border: 1px solid var(--sandal-border);">📜 UGC-NET Qualified Senior Nutritionist</div>
                        <div style="background: var(--white); padding: 0.85rem 1rem; border-radius: var(--radius-md); font-size: 0.85rem; font-weight: 600; color: var(--green-dark); border: 1px solid var(--sandal-border);">🏆 7+ Years Clinical &amp; Digital Experience</div>
                    </div>
                </div>
                <div class="about-widget-content">
                    <span class="tag">Meet Your Coach</span>
                    <h3>Meet Dietitian Shifana.I</h3>
                    <p>
                        As a <strong>Senior Nutritionist</strong> with an <strong>M.Sc. in Food Science & Nutrition</strong>, <strong>NET qualification</strong>, and certification as a <strong>Certified Diabetes Educator</strong>, Dietitian Shifana.I brings <strong>7+ years of experience</strong> in nutrition and wellness.
                    </p>
                    <p style="margin-top: 1rem;">
                        Her professional journey includes <strong>7+ years of experience as a Master Coach & Nutritionist at HealthifyMe</strong>, as well as experience as a <strong>Nutrition Coach at Uvi Health by Philips</strong>.
                    </p>
                    <p style="margin-top: 1rem;">
                        She specializes in <strong>weight loss, diabetes management, PMOS, thyroid health, fertility nutrition, hormonal health, and healthy weight gain</strong>. At SHIFAURA, she believes nutrition should be personal, practical, and sustainable—designed around your body, lifestyle, and goals.
                    </p>
                    
                    <div class="about-credentials">
                        <span class="about-credential-tag">M.Sc. Food & Nutrition</span>
                        <span class="about-credential-tag">UGC-NET Qualified</span>
                        <span class="about-credential-tag">Certified Diabetes Educator</span>
                        <span class="about-credential-tag">Former HealthifyMe Master Coach</span>
                    </div>

                    <!-- <a href="about.php" class="btn btn-secondary">Read More About Her Journey</a> -->
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Checklist Comparison -->
    <section>
        <div class="container">
            <div class="section-header center" style="max-width: 700px;">
                <span class="tag">Comparison</span>
                <h2>What Makes SHIFAURA Different?</h2>
                <p>Personalized. Evidence-Based. Human. We don't believe in quick fixes; we believe in sustainable health transformations.</p>
            </div>

            <div class="checklist-grid">
                <!-- Column Left: Generic Diets -->
                <div class="checklist-column">
                    <h3>Generic Crash Diets</h3>
                    <div class="checklist-items">
                        <div class="checklist-item no">
                            <i data-feather="x-circle"></i>
                            <span>One-size-fits-all rigid meal plans.</span>
                        </div>
                        <div class="checklist-item no">
                            <i data-feather="x-circle"></i>
                            <span>Drastic starvation and severe calorie deficits.</span>
                        </div>
                        <div class="checklist-item no">
                            <i data-feather="x-circle"></i>
                            <span>Removal of local staple foods and strict prohibitions.</span>
                        </div>
                        <div class="checklist-item no">
                            <i data-feather="x-circle"></i>
                            <span>No support or education on why you're eating certain foods.</span>
                        </div>
                        <div class="checklist-item no">
                            <i data-feather="x-circle"></i>
                            <span>Weight bounce-back immediately after stopping the program.</span>
                        </div>
                    </div>
                </div>

                <!-- Column Right: SHIFAURA -->
                <div class="checklist-column different">
                    <h3>The SHIFAURA Way</h3>
                    <div class="checklist-items">
                        <div class="checklist-item yes">
                            <i data-feather="check-circle"></i>
                            <span>Evidence-based, clinically aligned nutrition protocols.</span>
                        </div>
                        <div class="checklist-item yes">
                            <i data-feather="check-circle"></i>
                            <span>Personalized recommendations based on bloodwork and body history.</span>
                        </div>
                        <div class="checklist-item yes">
                            <i data-feather="check-circle"></i>
                            <span>Practical meal strategies integrating your home-cooked foods.</span>
                        </div>
                        <div class="checklist-item yes">
                            <i data-feather="check-circle"></i>
                            <span>Sustainable lifestyle changes prioritizing sleep, hydration, and movement.</span>
                        </div>
                        <div class="checklist-item yes">
                            <i data-feather="check-circle"></i>
                            <span>Ongoing daily guidance and direct messaging support with Shifana.I.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. Diet Packages Section -->
    <section class="section-bg-alt" id="packages">
        <div class="container">
            <div class="section-header center">
                <span class="tag">Pricing & Plans</span>
                <h2>Our Health & Diet Packages</h2>
                <p>Select a goal-oriented plan that works for you. All plans include direct care, structured guides, and continuous updates.</p>
            </div>

            <!-- Duration Selector (3-Month & 6-Month Programs Only) -->
            <div style="display: flex; justify-content: center; gap: 1rem; margin-bottom: 2.5rem;">
                <span class="badge" style="padding: 0.6rem 1.5rem; font-size: 0.85rem; background: var(--green-dark); color: var(--sandal-light);">Available Programs: 3 Months &amp; 6 Months</span>
            </div>

            <!-- Packages Cards Grid (No Price Display) -->
            <div class="packages-grid">
                <!-- Package 1: Weight Management -->
                <div class="package-card">
                    <span class="package-featured-badge" style="background: var(--green-medium); color: var(--white); top: 1rem; right: 1rem;">3 / 6 Months</span>
                    <h3 class="package-title">Weight Management</h3>
                    <p class="package-subtitle">For sustainable weight loss or healthy weight gain using practical dietary rules.</p>
                    <ul class="package-features">
                        <li><i data-feather="check"></i> <span>Customized diet &amp; food structures</span></li>
                        <li><i data-feather="check"></i> <span>Weekly review &amp; tracking metrics</span></li>
                        <li><i data-feather="check"></i> <span>Daily WhatsApp support (+91 6381757067)</span></li>
                        <li><i data-feather="check"></i> <span>Restaurant &amp; travel eating guidelines</span></li>
                        <li><i data-feather="check"></i> <span>Simple activity &amp; home workout plans</span></li>
                    </ul>
                    <a href="#book-consultation" class="btn btn-primary" style="margin-top: auto; justify-content: center;">Enroll Program</a>
                </div>

                <!-- Package 2: Diabetes Care (Featured) -->
                <div class="package-card featured">
                    <span class="package-featured-badge">Highly Specialised</span>
                    <h3 class="package-title">Diabetes Management</h3>
                    <p class="package-subtitle">Clinically aligned diets focusing on blood sugar control, insulin sensitivity, and medication tapering.</p>
                    <ul class="package-features">
                        <li><i data-feather="check"></i> <span>Low glycemic customized food charts</span></li>
                        <li><i data-feather="check"></i> <span>HbA1c &amp; sugar review tracker reviews</span></li>
                        <li><i data-feather="check"></i> <span>Continuous Glucose Monitor (CGM) support</span></li>
                        <li><i data-feather="check"></i> <span>Direct guidance by CDE Shifana.I</span></li>
                        <li><i data-feather="check"></i> <span>Cardiovascular and lifestyle updates</span></li>
                    </ul>
                    <a href="#book-consultation" class="btn btn-gold" style="margin-top: auto; justify-content: center;">Enroll Program</a>
                </div>

                <!-- Package 3: PMOS & Hormonal Health -->
                <div class="package-card">
                    <span class="package-featured-badge" style="background: var(--green-medium); color: var(--white); top: 1rem; right: 1rem;">3 / 6 Months</span>
                    <h3 class="package-title">PMOS &amp; Hormones</h3>
                    <p class="package-subtitle">Targeting insulin resistance, gut health, ovarian functions, and cycle normalization.</p>
                    <ul class="package-features">
                        <li><i data-feather="check"></i> <span>Insulin reversing culinary techniques</span></li>
                        <li><i data-feather="check"></i> <span>Monthly ovulation &amp; period cycle logs</span></li>
                        <li><i data-feather="check"></i> <span>Hormonal evaluation reviews &amp; reports help</span></li>
                        <li><i data-feather="check"></i> <span>Acne, hirsutism, &amp; hair fall diet fixes</span></li>
                        <li><i data-feather="check"></i> <span>Sleep &amp; stress management protocols</span></li>
                    </ul>
                    <a href="#book-consultation" class="btn btn-primary" style="margin-top: auto; justify-content: center;">Enroll Program</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. Testimonials Section (Disabled per user request) -->
    <!-- 
    <section>
        <div class="container">
            <div class="section-header center">
                <span class="tag">Success Stories</span>
                <h2>Real Transformations. Real People.</h2>
            </div>
        </div>
    </section> 
    -->

    <!-- 9. Book a Consultation Section -->
    <section class="section-bg-alt" id="book-consultation">
        <div class="container">
            <div class="consultation-card">
                <!-- Left Banner Info -->
                <div class="consultation-info">
                    <div class="consultation-info-header">
                        <h3>Book a Private Consultation</h3>
                        <p>Take the first step toward lasting health. Let's discuss your health profile, hurdles, and map out a tailored strategy.</p>
                    </div>
                    
                    <div class="consultation-contacts">
                        <div class="consultation-contact-item">
                            <i data-feather="mail"></i>
                            <a href="mailto:info@dietitianshifana.com" style="color: inherit;">info@dietitianshifana.com</a>
                        </div>
                        <div class="consultation-contact-item">
                            <i data-feather="phone"></i>
                            <a href="tel:+916381757067" style="color: inherit;">+91 6381 757 067</a>
                        </div>
                        <div class="consultation-contact-item">
                            <i data-feather="message-circle"></i>
                            <a href="https://wa.me/916381757067" target="_blank" rel="noopener noreferrer" style="color: inherit;">WhatsApp: +91 6381 757 067</a>
                        </div>
                        <div class="consultation-contact-item">
                            <i data-feather="map-pin"></i>
                            <span>Online consultation worldwide</span>
                        </div>
                    </div>

                    <div>
                        <div style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--gold); margin-bottom: 0.75rem;">Follow SHIFAURA</div>
                        <div class="consultation-socials">
                            <a href="#" class="consultation-social-icon" aria-label="Instagram"><i data-feather="instagram" style="width: 16px; height: 16px;"></i></a>
                            <a href="#" class="consultation-social-icon" aria-label="Facebook"><i data-feather="facebook" style="width: 16px; height: 16px;"></i></a>
                            <a href="#" class="consultation-social-icon" aria-label="LinkedIn"><i data-feather="linkedin" style="width: 16px; height: 16px;"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Right Form Area -->
                <div class="consultation-form-container">
                    <div class="consultation-form">
                        <h4>Tell Us About Yourself</h4>
                        
                        <?php if ($booking_success): ?>
                            <div style="background-color: var(--green-light); border: 1px solid var(--green-medium); color: var(--green-dark); padding: 1.25rem; border-radius: var(--radius-sm); margin-bottom: 2rem; display: flex; align-items: center; gap: 0.75rem;">
                                <i data-feather="check-circle" style="color: var(--success);"></i>
                                <div>
                                    <strong style="display: block;">Consultation Requested!</strong>
                                    We have received your details. Dietitian Shifana.I or her coordinator will call you back within 24 hours to schedule your session.
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($booking_error)): ?>
                            <div style="background-color: #FEE2E2; border: 1px solid #EF4444; color: #B91C1C; padding: 1.25rem; border-radius: var(--radius-sm); margin-bottom: 2rem; display: flex; align-items: center; gap: 0.75rem;">
                                <i data-feather="alert-circle"></i>
                                <span><?php echo $booking_error; ?></span>
                            </div>
                        <?php endif; ?>

                        <!-- Standard Form submission -->
                        <form method="POST" action="index.php#book-consultation">
                            <input type="hidden" name="action" value="book_consultation">
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="name">Your Name *</label>
                                    <input type="text" id="name" name="name" required placeholder="e.g. John Doe">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address *</label>
                                    <input type="email" id="email" name="email" required placeholder="e.g. john@example.com">
                                </div>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="phone">Phone Number *</label>
                                    <input type="tel" id="phone" name="phone" required placeholder="e.g. +91 9876543210">
                                </div>
                                <div class="form-group">
                                    <label for="health_goal">Primary Health Goal *</label>
                                    <select id="health_goal" name="health_goal" required>
                                        <option value="" disabled selected>Select a goal</option>
                                        <option value="Weight Loss">Weight Loss & Fat Reduction</option>
                                        <option value="Weight Gain">Healthy Weight Gain</option>
                                        <option value="Diabetes Management">Diabetes Management</option>
                                        <option value="PMOS / Hormones">PMOS & Hormonal Health</option>
                                        <option value="Thyroid Management">Thyroid Health</option>
                                        <option value="Fertility Nutrition">Fertility Nutrition</option>
                                        <option value="General Wellness">General Wellness & 8 Pillars</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="preferred_date">Preferred Date *</label>
                                    <input type="date" id="preferred_date" name="preferred_date" required min="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="preferred_time">Preferred Time slot *</label>
                                    <select id="preferred_time" name="preferred_time" required>
                                        <option value="" disabled selected>Select time range</option>
                                        <option value="10:00 AM - 12:00 PM">Morning (10:00 AM - 12:00 PM)</option>
                                        <option value="12:00 PM - 03:00 PM">Midday (12:00 PM - 03:00 PM)</option>
                                        <option value="03:00 PM - 05:00 PM">Afternoon (03:00 PM - 05:00 PM)</option>
                                        <option value="05:00 PM - 07:00 PM">Evening (05:00 PM - 07:00 PM)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group full-width">
                                <label for="message">Medical Background / Short Message</label>
                                <textarea id="message" name="message" rows="4" placeholder="Briefly share any medical conditions (e.g. high BP, thyroid) or lifestyle details."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 1rem;">Submit Consultation Request</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Calendly option placeholder for the future -->
            <div style="text-align: center; margin-top: 3rem; background: var(--white); border: 1px dashed var(--sandal-border); padding: 1.5rem; border-radius: var(--radius-md);">
                <p style="font-size: 0.9rem; color: var(--text-muted);">
                    <i data-feather="calendar" style="width: 16px; height: 16px; vertical-align: middle; margin-right: 0.5rem; color: var(--gold);"></i>
                    Prefer instant booking? You can also schedule an appointment directly using our <strong>Calendly Calendar</strong>.
                    <a href="https://calendly.com/shifaura-wellness" target="_blank" rel="noopener noreferrer" style="color: var(--green-dark); font-weight: 600; text-decoration: underline; margin-left: 0.5rem;">Launch Calendly Widget &rarr;</a>
                </p>
            </div>
        </div>
    </section>

<?php
include_once __DIR__ . '/includes/footer.php';
?>
