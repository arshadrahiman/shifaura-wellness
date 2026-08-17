<?php
/**
 * SHIFAURA - About Page
 */
require_once __DIR__ . '/db/config.php';

$page_title = 'Meet Dietitian Shifana.I | Senior Nutritionist';
$page_description = 'Learn about Dietitian Shifana.I, M.Sc. Food & Nutrition, Certified Diabetes Educator. Former Master Coach at HealthifyMe with 7+ years of experience.';
include_once __DIR__ . '/includes/header.php';
?>

    <!-- Page Title Header -->
    <header class="page-header">
        <div class="container">
            <span class="badge" style="margin-bottom: 0.75rem;">Founder & Senior Coach</span>
            <h1>Meet Dietitian Shifana.I</h1>
            <p>M.Sc. Food Science & Nutrition | Certified Diabetes Educator | Former HealthifyMe Master Coach</p>
        </div>
    </header>

    <!-- Detailed Biography Section -->
    <section>
        <div class="container" style="max-width: 1000px;">
            <div class="about-widget-grid" style="grid-template-columns: 0.9fr 1.1fr;">
                <div class="about-widget-image">
                    <!-- Shifana.I Portrait placeholder. We will replace this with a generated image. -->
                    <img src="assets/images/shifana_portrait.png" alt="Dietitian Shifana.I, M.Sc. Nutrition" style="width: 100%; height: 520px; object-fit: cover;">
                </div>
                <div>
                    <h2 style="font-size: 2.25rem; margin-bottom: 1.5rem;">Academic Excellence & Clinical Expertise</h2>
                    <p style="margin-bottom: 1rem; font-size: 1.05rem; color: var(--text-dark); line-height: 1.7;">
                        As a <strong>Senior Nutritionist</strong> with an <strong>M.Sc. in Food Science & Nutrition</strong>, a <strong>National Eligibility Test (NET) qualification</strong>, and certification as a <strong>Certified Diabetes Educator</strong>, Dietitian Shifana.I brings <strong>7+ years of clinical and digital wellness experience</strong>.
                    </p>
                    <p style="margin-bottom: 1rem;">
                        Before launching <strong>SHIFAURA</strong>, she spent <strong>7+ years as a Master Coach & Nutritionist at HealthifyMe</strong>, mentoring thousands of clients in fat loss, metabolic recovery, and lifestyle tuning. She also coached clients under specialized clinical plans at <strong>Uvi Health by Philips</strong>, refining her knowledge of female endocrinology, PMOS, and thyroid protocols.
                    </p>
                    <p style="margin-bottom: 1.5rem;">
                        She specializes in:
                        <ul style="list-style: none; display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; margin-bottom: 1.5rem; padding-left: 0;">
                            <li style="font-size: 0.9rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem;"><i data-feather="check" style="color: var(--gold); width: 16px; height: 16px;"></i> Weight Management</li>
                            <li style="font-size: 0.9rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem;"><i data-feather="check" style="color: var(--gold); width: 16px; height: 16px;"></i> Diabetes Management</li>
                            <li style="font-size: 0.9rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem;"><i data-feather="check" style="color: var(--gold); width: 16px; height: 16px;"></i> PMOS & Hormones</li>
                            <li style="font-size: 0.9rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem;"><i data-feather="check" style="color: var(--gold); width: 16px; height: 16px;"></i> Thyroid Health</li>
                            <li style="font-size: 0.9rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem;"><i data-feather="check" style="color: var(--gold); width: 16px; height: 16px;"></i> Fertility Nutrition</li>
                            <li style="font-size: 0.9rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem;"><i data-feather="check" style="color: var(--gold); width: 16px; height: 16px;"></i> Circadian Restoration</li>
                        </ul>
                    </p>
                    <div style="background-color: var(--green-light); border-left: 3px solid var(--green-dark); padding: 1.25rem; border-radius: var(--radius-sm);">
                        <p style="font-style: italic; color: var(--green-dark); font-size: 0.95rem; line-height: 1.5;">
                            "Nutrition should be personal, practical, and sustainable. It is not about starvation or checking off checkboxes in a rigid, impossible diet sheet. It is about crafting a daily workflow that naturally aligns with your cellular biology, tastes, and lifestyle."
                        </p>
                        <span style="display: block; text-align: right; font-family: 'Cormorant Garamond', serif; font-weight: 700; color: var(--green-dark); margin-top: 0.5rem;">— Dietitian Shifana.I</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Professional Timeline / Credentials Details -->
    <section class="section-bg-alt">
        <div class="container" style="max-width: 800px;">
            <div class="section-header center">
                <span class="tag">Timeline</span>
                <h2>Career Achievements & Experience</h2>
                <p>A track record of translating academic food science research into highly successful, real-world digital health initiatives.</p>
            </div>

            <div class="diff-steps" style="position: relative;">
                <!-- Step 1: HealthifyMe -->
                <div class="diff-step">
                    <div class="diff-number"><i data-feather="award" style="color: var(--gold); width: 32px; height: 32px;"></i></div>
                    <div class="diff-text">
                        <h3>Master Coach & Senior Nutritionist &bull; HealthifyMe</h3>
                        <span class="badge" style="margin-bottom: 0.5rem; font-size: 0.65rem;">7+ Years (2018 - 2024)</span>
                        <p>Managed, coached, and calibrated lifestyle habits for over 3,000 clients globally. Led critical clinical cases, mentored junior dietitians, and created advanced meal structures for complex metabolic syndromes.</p>
                    </div>
                </div>

                <!-- Step 2: Philips / Uvi Health -->
                <div class="diff-step">
                    <div class="diff-number"><i data-feather="activity" style="color: var(--gold); width: 32px; height: 32px;"></i></div>
                    <div class="diff-text">
                        <h3>Nutrition Coach &bull; Uvi Health (by Philips)</h3>
                        <span class="badge" style="margin-bottom: 0.5rem; font-size: 0.65rem;">Specialist Program</span>
                        <p>Refined ovarian, thyroid, and reproductive health coaching workflows. Collaborated with gynecologists and endocrinologists to craft multi-disciplinary reversal plans for PMOS and subfertility patients.</p>
                    </div>
                </div>

                <!-- Step 3: Education & Research -->
                <div class="diff-step">
                    <div class="diff-number"><i data-feather="book-open" style="color: var(--gold); width: 32px; height: 32px;"></i></div>
                    <div class="diff-text">
                        <h3>Academic Foundations</h3>
                        <span class="badge" style="margin-bottom: 0.5rem; font-size: 0.65rem;">M.Sc. & UGC-NET</span>
                        <p>Completed Post Graduation (M.Sc.) in Food Science and Nutrition with distinction. Qualified the National Eligibility Test (NET) for research and lectureship. Subsequently certified as a Diabetes Educator to specialize in glycemic control mechanics.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Her Approach detail -->
    <section>
        <div class="container" style="text-align: center; max-width: 800px;">
            <div class="section-header center">
                <span class="tag">Philosophy</span>
                <h2>Her Approach</h2>
                <p>Four pillars that transform nutrition from a temporary restriction to a permanent biological alignment.</p>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; text-align: left;">
                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); padding: 1.5rem; border-radius: var(--radius-md);">
                    <h3 style="font-size: 1.5rem; color: var(--gold); margin-bottom: 0.5rem;">1. Understand</h3>
                    <p style="font-size: 0.85rem;">Deep audit of sleep patterns, stress levels, medical reports, family history, and home kitchen staples.</p>
                </div>
                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); padding: 1.5rem; border-radius: var(--radius-md);">
                    <h3 style="font-size: 1.5rem; color: var(--gold); margin-bottom: 0.5rem;">2. Personalize</h3>
                    <p style="font-size: 0.85rem;">No generic charts. Meal configurations designed entirely around your native routine, staples, and tastes.</p>
                </div>
                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); padding: 1.5rem; border-radius: var(--radius-md);">
                    <h3 style="font-size: 1.5rem; color: var(--gold); margin-bottom: 0.5rem;">3. Nourish</h3>
                    <p style="font-size: 0.85rem;">Shifting focal points away from calorie counts and deficits to micronutrient density and glycemic control.</p>
                </div>
                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); padding: 1.5rem; border-radius: var(--radius-md);">
                    <h3 style="font-size: 1.5rem; color: var(--gold); margin-bottom: 0.5rem;">4. Transform</h3>
                    <p style="font-size: 0.85rem;">Replacing willpower demands with micro-rituals that build sustainable habits, yielding lifelong wellness.</p>
                </div>
            </div>
            
            <p style="margin-top: 3rem; font-size: 1.15rem; color: var(--text-dark);">
                <strong>Because lasting health isn't about following a perfect diet.</strong>
                <br>It's about creating a healthier way of living that works for you.
            </p>
            
            <div style="margin-top: 2rem;">
                <a href="index.php#book-consultation" class="btn btn-primary">Book Consultation With Shifana.I</a>
            </div>
        </div>
    </section>

<?php
include_once __DIR__ . '/includes/footer.php';
?>
