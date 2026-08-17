<?php
/**
 * SHIFAURA - Approach Page
 */
require_once __DIR__ . '/db/config.php';

$page_title = 'Our Approach | The 8 Pillars of Wellness';
$page_description = 'Learn about SHIFAURA\'s science-backed, holistic health methodology. How we blend evidence-based dietetics with the 8 Pillars of wellness.';
include_once __DIR__ . '/includes/header.php';
?>

    <!-- Page Title Header -->
    <header class="page-header">
        <div class="container">
            <span class="badge" style="margin-bottom: 0.75rem;">Wellness Architecture</span>
            <h1>Our Approach</h1>
            <p>A science-backed, holistic system designed around how the human body naturally functions.</p>
        </div>
    </header>

    <!-- Introductory Paragraph -->
    <section>
        <div class="container" style="max-width: 850px; text-align: center;">
            <h2 style="margin-bottom: 1.5rem; font-size: 2.25rem;">Evidence-Based. Holistic. Personalized.</h2>
            <p style="font-size: 1.15rem; line-height: 1.8; color: var(--text-dark); margin-bottom: 2rem;">
                Lasting health isn't about willpower or starvation. It is about understanding your biology and feeding your body what it needs to restore balance. At SHIFAURA, we combine clinical dietetics (backed by laboratory markers and metabolic profiles) with ancient lifestyle wisdom centered around the 8 Pillars of Wellness.
            </p>
            <div style="width: 80px; height: 1px; background-color: var(--gold); margin: 0 auto;"></div>
        </div>
    </section>

    <!-- Detailed 8 Pillars Grid -->
    <section class="section-bg-alt">
        <div class="container">
            <div class="section-header center">
                <span class="tag">Integrated Framework</span>
                <h2>The 8 Pillars of SHIFAURA Wellness</h2>
                <p>We review and track these 8 core markers of health in every program, helping you establish lifestyle systems that naturally reverse metabolic imbalances.</p>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2.5rem;">
                <!-- Pillar 1 -->
                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); padding: 2.5rem; border-radius: var(--radius-md); display: flex; gap: 1.5rem;">
                    <span style="font-size: 3rem; flex-shrink: 0; line-height: 1;">🥗</span>
                    <div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">1. Nourish — Nutrition</h3>
                        <p style="font-size: 0.9rem; line-height: 1.6;">Eating is not just about calories; it is about cellular communication. We build food structures rich in micronutrients, anti-inflammatory compounds, and gut-friendly elements, all tailored around your home kitchen staples.</p>
                    </div>
                </div>

                <!-- Pillar 2 -->
                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); padding: 2.5rem; border-radius: var(--radius-md); display: flex; gap: 1.5rem;">
                    <span style="font-size: 3rem; flex-shrink: 0; line-height: 1;">🏃</span>
                    <div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">2. Move — Physical Activity</h3>
                        <p style="font-size: 0.9rem; line-height: 1.6;">We reject grueling workouts that trigger high cortisol (stress hormones) and exacerbate thyroid or PMOS issues. Instead, we introduce simple movement strategies, resistance training, and daily step benchmarks.</p>
                    </div>
                </div>

                <!-- Pillar 3 -->
                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); padding: 2.5rem; border-radius: var(--radius-md); display: flex; gap: 1.5rem;">
                    <span style="font-size: 3rem; flex-shrink: 0; line-height: 1;">💧</span>
                    <div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">3. Hydrate — Water</h3>
                        <p style="font-size: 0.9rem; line-height: 1.6;">Chronic dehydration slows down kidney filtration and slows overall metabolic function. We establish optimal water schedules, teaching you how to structure electrolyte intake for cellular hydration.</p>
                    </div>
                </div>

                <!-- Pillar 4 -->
                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); padding: 2.5rem; border-radius: var(--radius-md); display: flex; gap: 1.5rem;">
                    <span style="font-size: 3rem; flex-shrink: 0; line-height: 1;">🌬️</span>
                    <div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">4. Breathe — Air & Breath</h3>
                        <p style="font-size: 0.9rem; line-height: 1.6;">Your autonomic nervous system controls digestion and fat burning. We integrate simple nasal breathing protocols and mindful breathwork to shift your body from 'fight-or-flight' into 'rest-and-digest' mode.</p>
                    </div>
                </div>

                <!-- Pillar 5 -->
                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); padding: 2.5rem; border-radius: var(--radius-md); display: flex; gap: 1.5rem;">
                    <span style="font-size: 3rem; flex-shrink: 0; line-height: 1;">😴</span>
                    <div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">5. Restore — Sleep</h3>
                        <p style="font-size: 0.9rem; line-height: 1.6;">Hormones like insulin, ghrelin, and cortisol are regulated during deep sleep. We build circadian sleep routines (sleeping and waking at consistent times) to naturally balance hunger and glucose metabolism.</p>
                    </div>
                </div>

                <!-- Pillar 6 -->
                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); padding: 2.5rem; border-radius: var(--radius-md); display: flex; gap: 1.5rem;">
                    <span style="font-size: 3rem; flex-shrink: 0; line-height: 1;">❤️</span>
                    <div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">6. Balance — Emotional Wellbeing</h3>
                        <p style="font-size: 0.9rem; line-height: 1.6;">Mental stress spikes blood sugars and blocks fat oxidation. We support you with simple stress-release habits, mindful eating training, and tools to build emotional resilience.</p>
                    </div>
                </div>

                <!-- Pillar 7 -->
                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); padding: 2.5rem; border-radius: var(--radius-md); display: flex; gap: 1.5rem;">
                    <span style="font-size: 3rem; flex-shrink: 0; line-height: 1;">✨</span>
                    <div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">7. Connect — Spiritual Wellbeing</h3>
                        <p style="font-size: 0.9rem; line-height: 1.6;">Connecting with a higher purpose and practicing daily gratitude resets the vagal nerve, which controls digestive organs. We help you create daily reflection rituals to calm the mind.</p>
                    </div>
                </div>

                <!-- Pillar 8 -->
                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); padding: 2.5rem; border-radius: var(--radius-md); display: flex; gap: 1.5rem;">
                    <span style="font-size: 3rem; flex-shrink: 0; line-height: 1;">🌱</span>
                    <div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">8. Reconnect — Nature & Sunlight</h3>
                        <p style="font-size: 0.9rem; line-height: 1.6;">Human cells require direct contact with the earth and morning sunlight to reset metabolic clocks. We guide you on morning sun exposure and grounding practices to optimize mitochondrial health.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- The 4 Core Methodology principles details -->
    <section>
        <div class="container" style="max-width: 900px;">
            <div class="section-header center">
                <span class="tag">Methodology</span>
                <h2>Our Client Journey</h2>
                <p>Here is what to expect when you sign up for a program with Dietitian Shifana.I.</p>
            </div>

            <div style="display: flex; flex-direction: column; gap: 3rem;">
                <div style="display: grid; grid-template-columns: 80px 1fr; gap: 2rem; align-items: flex-start;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background-color: var(--green-light); color: var(--green-dark); font-size: 2rem; font-weight: 700; display: flex; align-items: center; justify-content: center; font-family: 'Cormorant Garamond', serif;">01</div>
                    <div>
                        <h3 style="font-size: 1.65rem; margin-bottom: 0.5rem; color: var(--green-dark);">Detailed Metabolic & Lifestyle Audit</h3>
                        <p>Upon registration, you receive a detailed intake diary. You share recent blood test reports, clinical history, sleep metrics, kitchen configurations, and typical schedule. Shifana.I reviews this audit personally during your onboarding call.</p>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 80px 1fr; gap: 2rem; align-items: flex-start;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background-color: var(--green-light); color: var(--green-dark); font-size: 2rem; font-weight: 700; display: flex; align-items: center; justify-content: center; font-family: 'Cormorant Garamond', serif;">02</div>
                    <div>
                        <h3 style="font-size: 1.65rem; margin-bottom: 0.5rem; color: var(--green-dark);">Customizing Your Food & Wellness Blueprints</h3>
                        <p>We build your customized diet layout. We don't exclude major food groups or staple grains. We show you proper portion metrics, optimal nutrient pairings, and provide healthy recipe ideas that fit into your lifestyle.</p>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 80px 1fr; gap: 2rem; align-items: flex-start;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background-color: var(--green-light); color: var(--green-dark); font-size: 2rem; font-weight: 700; display: flex; align-items: center; justify-content: center; font-family: 'Cormorant Garamond', serif;">03</div>
                    <div>
                        <h3 style="font-size: 1.65rem; margin-bottom: 0.5rem; color: var(--green-dark);">Continuous Support & Weekly Calibrations</h3>
                        <p>Every week, we evaluate your weight markers, symptoms, and consistency. Based on your inputs, we refine your food blueprints. Throughout the week, you have direct WhatsApp access to Shifana.I for support.</p>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 80px 1fr; gap: 2rem; align-items: flex-start;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background-color: var(--green-light); color: var(--green-dark); font-size: 2rem; font-weight: 700; display: flex; align-items: center; justify-content: center; font-family: 'Cormorant Garamond', serif;">04</div>
                    <div>
                        <h3 style="font-size: 1.65rem; margin-bottom: 0.5rem; color: var(--green-dark);">Sustainable Habit Integration</h3>
                        <p>As you progress, we focus on building sustainable habits. Our goal is to teach you how to manage your own nutrition, helping you maintain your results and support long-term wellbeing for years to come.</p>
                    </div>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 5rem;">
                <a href="services.php" class="btn btn-primary">Find Your Program &rarr;</a>
            </div>
        </div>
    </section>

<?php
include_once __DIR__ . '/includes/footer.php';
?>
