<?php
/**
 * SHIFAURA - Global Header Component
 */
require_once __DIR__ . '/../db/config.php';

// Function to check if a navigation link is active
function is_active_link($page_name) {
    $current_page = basename($_SERVER['PHP_SELF']);
    return ($current_page === $page_name) ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO & Local Digital Marketing Meta Tags -->
    <title><?php echo isset($page_title) ? $page_title . ' | SHIFAURA by Dietitian Shifana.I' : 'Dietitian Shifana.I | Best Clinical Nutritionist in Coimbatore, Tamil Nadu & Kerala'; ?></title>
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : 'Senior Clinical Dietitian Shifana.I (M.Sc. Food & Nutrition, Certified Diabetes Educator). In-Clinic consultation at Podanur, Coimbatore & Worldwide Online consultations across Tamil Nadu (Chennai, Madurai, Salem) & Kerala (Kochi, Calicut, Palakkad). Weight Loss, PMOS, Diabetes Care.'; ?>">
    <meta name="keywords" content="Best Dietitian in Coimbatore, Clinical Nutritionist Podanur, Certified Diabetes Educator Coimbatore, PCOS Dietitian Tamil Nadu, Online Dietitian Kerala, Weight Loss Consultation Coimbatore, Dietitian Shifana.I, Dietitian Kochi Calicut Palakkad, Fertility Nutritionist Coimbatore">
    <meta name="author" content="Dietitian Shifana.I">
    <meta name="robots" content="index, follow">
    <meta name="geo.region" content="IN-TN">
    <meta name="geo.placename" content="Coimbatore, Podanur, Tamil Nadu">
    <meta name="geo.position" content="10.9633;76.9734">
    <meta name="ICBM" content="10.9633, 76.9734">
    <link rel="canonical" href="https://www.dietitianshifana.com/">
    
    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="Dietitian Shifana.I | Clinical Nutrition & Diabetes Care (Coimbatore, Tamil Nadu & Kerala)">
    <meta property="og:description" content="Evidence-based nutrition and holistic wellness by Dietitian Shifana.I (7+ Yrs Exp, Former HealthifyMe Master Coach). Online & In-Clinic Podanur consultations.">
    <meta property="og:url" content="https://www.dietitianshifana.com/">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://www.dietitianshifana.com/assets/images/logo.png">

    <!-- Schema.org JSON-LD Structured Data for Local SEO (Coimbatore, Tamil Nadu, Kerala) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "MedicalBusiness",
      "name": "SHIFAURA by Dietitian Shifana.I",
      "image": "https://www.dietitianshifana.com/assets/images/logo.png",
      "@id": "https://www.dietitianshifana.com",
      "url": "https://www.dietitianshifana.com",
      "telephone": "+916381757067",
      "priceRange": "$$",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Nila Complex, Near Dmart, Podanur",
        "addressLocality": "Coimbatore",
        "addressRegion": "Tamil Nadu",
        "postalCode": "641023",
        "addressCountry": "IN"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 10.9633,
        "longitude": 76.9734
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday"
        ],
        "opens": "10:00",
        "closes": "19:00"
      },
      "areaServed": [
        {"@type": "AdministrativeArea", "name": "Coimbatore"},
        {"@type": "AdministrativeArea", "name": "Podanur"},
        {"@type": "AdministrativeArea", "name": "Tamil Nadu"},
        {"@type": "AdministrativeArea", "name": "Kerala"},
        {"@type": "City", "name": "Chennai"},
        {"@type": "City", "name": "Madurai"},
        {"@type": "City", "name": "Kochi"},
        {"@type": "City", "name": "Kozhikode"},
        {"@type": "City", "name": "Palakkad"}
      ],
      "medicalSpecialty": [
        "Dietetics",
        "Endocrinology",
        "Diabetes Care",
        "Women Health"
      ]
    }
    </script>

    <!-- Schema.org FAQPage Structured Data for Google Rich Snippets -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "How do Online Virtual Consultations work?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Online consultations are conducted via 1-on-1 video calls (WhatsApp / Zoom / Google Meet). You receive your customized diet chart on WhatsApp/Email, alongside daily meal tracking."
          }
        },
        {
          "@type": "Question",
          "name": "Where is the clinic located for In-Person consultations?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Our clinic is located at Nila Complex, Near Dmart, Podanur, Coimbatore - 641023."
          }
        },
        {
          "@type": "Question",
          "name": "Will the diet plans include traditional South Indian home foods?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes! We strictly follow a No Crash Diet philosophy using traditional home kitchen foods adapted to your medical profile."
          }
        }
      ]
    }
    </script>
    
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Feather Icons for modern vector icons (SVG) -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>

    <!-- Header Navigation -->
    <header>
        <div class="container header-inner">
            <!-- Brand Logo -->
            <a href="index.php" class="logo-img-link">
                <img src="assets/images/logo.png" alt="SHIFAURA by Dietitian Shifana.I" style="height: 54px; width: auto; display: block;">
            </a>

            <!-- Desktop Nav Links -->
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php" class="<?php echo is_active_link('index.php'); ?>">Home</a></li>
                    <li><a href="index.php#pillars">8 Pillars</a></li>
                    <li><a href="index.php#services">Clinical Programs</a></li>
                    <li><a href="index.php#packages">Plans &amp; Pricing</a></li>
                    <li><a href="index.php#faq-section">FAQ</a></li>
                    <li><a href="index.php#book-consultation">Contact Clinic</a></li>
                </ul>
            </nav>

            <!-- Actions -->
            <div class="header-actions">
                <a href="index.php#book-consultation" class="btn btn-primary" id="header-cta-btn">Book Consultation</a>
                <button class="menu-toggle" aria-label="Toggle Navigation">
                    <i data-feather="menu"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Nav Drawer -->
        <div class="mobile-nav">
            <ul class="mobile-nav-links">
                <li><a href="index.php" class="<?php echo is_active_link('index.php'); ?>">Home</a></li>
                <li><a href="index.php#pillars">8 Pillars</a></li>
                <li><a href="index.php#services">Clinical Programs</a></li>
                <li><a href="index.php#packages">Plans &amp; Pricing</a></li>
                <li><a href="index.php#faq-section">FAQ</a></li>
                <li><a href="index.php#book-consultation">Contact Clinic</a></li>
                <li style="margin-top: 1rem;"><a href="index.php#book-consultation" class="btn btn-primary" style="display: block; text-align: center; color: var(--sandal-light);">Book Consultation</a></li>
            </ul>
        </div>
    </header>
