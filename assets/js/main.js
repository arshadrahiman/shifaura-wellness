/**
 * SHIFAURA - Global JavaScript Functionality
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile Menu Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileNav = document.querySelector('.mobile-nav');

    if (menuToggle && mobileNav) {
        menuToggle.addEventListener('click', () => {
            const isActive = mobileNav.classList.toggle('active');
            menuToggle.innerHTML = isActive 
                ? '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>' 
                : '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>';
        });
    }

    // 2. Testimonial Slider
    const slides = document.querySelectorAll('.testimonial-slide');
    const dots = document.querySelectorAll('.testimonial-dot');
    let currentSlide = 0;
    let slideInterval;

    if (slides.length > 0) {
        const showSlide = (index) => {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            slides[index].classList.add('active');
            if (dots[index]) {
                dots[index].classList.add('active');
            }
            currentSlide = index;
        };

        const nextSlide = () => {
            let next = (currentSlide + 1) % slides.length;
            showSlide(next);
        };

        // Click indicators
        dots.forEach((dot, idx) => {
            dot.addEventListener('click', () => {
                showSlide(idx);
                resetInterval();
            });
        });

        const resetInterval = () => {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, 6000);
        };

        // Start Auto Slider
        resetInterval();
        showSlide(0);
    }

    // 3. Pricing Package Toggle (Monthly vs Quarterly/3-Month)
    const priceToggle = document.getElementById('price-duration-toggle');
    if (priceToggle) {
        priceToggle.addEventListener('change', () => {
            const isQuarterly = priceToggle.checked;
            const priceElements = document.querySelectorAll('.package-price');
            const periodElements = document.querySelectorAll('.package-price-period');

            priceElements.forEach(priceEl => {
                const card = priceEl.closest('.package-card');
                if (card) {
                    const monthlyPrice = card.getAttribute('data-price-monthly');
                    const quarterlyPrice = card.getAttribute('data-price-quarterly');
                    
                    if (isQuarterly) {
                        priceEl.textContent = Number(quarterlyPrice).toLocaleString('en-IN');
                    } else {
                        priceEl.textContent = Number(monthlyPrice).toLocaleString('en-IN');
                    }
                }
            });

            periodElements.forEach(periodEl => {
                periodEl.textContent = isQuarterly ? ' / 3 Months' : ' / Month';
            });
        });
    }

    // 4. Checkout Payment Tab Switcher & Validation
    const paymentMethods = document.querySelectorAll('.payment-method-btn');
    const paymentPanels = document.querySelectorAll('.payment-details-panel');

    if (paymentMethods.length > 0) {
        paymentMethods.forEach(method => {
            method.addEventListener('click', () => {
                paymentMethods.forEach(m => m.classList.remove('active'));
                paymentPanels.forEach(p => p.classList.remove('active'));
                method.classList.add('active');
                
                const targetPanelId = method.getAttribute('data-target');
                const targetPanel = document.getElementById(targetPanelId);
                if (targetPanel) {
                    targetPanel.classList.add('active');
                }

                // Update hidden input for selected payment method
                const hiddenInput = document.getElementById('selected_payment_method');
                if (hiddenInput) {
                    hiddenInput.value = method.getAttribute('data-method');
                }
            });
        });
    }

    // Card Input Auto Formatting
    const cardNumberInput = document.getElementById('card_number');
    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formatted = '';
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formatted += ' ';
                }
                formatted += value[i];
            }
            e.target.value = formatted.substring(0, 19); // 16 digits + 3 spaces
        });
    }

    const cardExpiryInput = document.getElementById('card_expiry');
    if (cardExpiryInput) {
        cardExpiryInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            if (value.length > 2) {
                e.target.value = value.substring(0, 2) + '/' + value.substring(2, 4);
            } else {
                e.target.value = value;
            }
        });
    }

    // 5. Google Sheets Integration Handler for Contact Form
    // To activate, paste your Google Apps Script Web App URL below:
    window.GOOGLE_SHEET_URL = ''; // e.g., 'https://script.google.com/macros/s/AKfycb.../exec'

    const consultationForm = document.querySelector('form[action="index.php#book-consultation"]');
    if (consultationForm) {
        consultationForm.addEventListener('submit', (e) => {
            if (window.GOOGLE_SHEET_URL && window.GOOGLE_SHEET_URL.startsWith('http')) {
                e.preventDefault();
                const formData = new FormData(consultationForm);
                const submitBtn = consultationForm.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Submitting Request...';
                }

                fetch(window.GOOGLE_SHEET_URL, {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    alert('Thank you! Your consultation request has been saved to Google Sheets and emailed to info@dietitianshifana.com.');
                    consultationForm.reset();
                })
                .catch(err => {
                    alert('Thank you! Your consultation request has been submitted successfully.');
                    consultationForm.reset();
                })
                .finally(() => {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Submit Consultation Request';
                    }
                });
            }
        });
    }
});
