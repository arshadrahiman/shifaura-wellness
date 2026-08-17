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

    // 5. WhatsApp Form Submission Handler for "Tell Us About Yourself"
    const consultationForm = document.querySelector('form[action="index.php#book-consultation"], #book-consultation form');
    if (consultationForm) {
        consultationForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const nameInput = consultationForm.querySelector('#name') || consultationForm.querySelector('[name="name"]');
            const emailInput = consultationForm.querySelector('#email') || consultationForm.querySelector('[name="email"]');
            const phoneInput = consultationForm.querySelector('#phone') || consultationForm.querySelector('[name="phone"]');
            const goalInput = consultationForm.querySelector('#health_goal') || consultationForm.querySelector('[name="health_goal"]');
            const dateInput = consultationForm.querySelector('#preferred_date') || consultationForm.querySelector('[name="preferred_date"]');
            const timeInput = consultationForm.querySelector('#preferred_time') || consultationForm.querySelector('[name="preferred_time"]');
            const msgInput = consultationForm.querySelector('#message') || consultationForm.querySelector('[name="message"]');

            const name = nameInput ? nameInput.value.trim() : '';
            const email = emailInput ? emailInput.value.trim() : '';
            const phone = phoneInput ? phoneInput.value.trim() : '';
            const goal = goalInput ? goalInput.value : '';
            const date = dateInput ? dateInput.value : '';
            const time = timeInput ? timeInput.value : '';
            const message = msgInput ? msgInput.value.trim() : '';

            const whatsappMessage = `Hello Dietitian Shifana.I, I would like to book a consultation for SHIFAURA Wellness:\n\n` +
                `📌 *Name:* ${name}\n` +
                `📧 *Email:* ${email}\n` +
                `📞 *Phone:* ${phone}\n` +
                `🎯 *Health Goal:* ${goal}\n` +
                `📅 *Preferred Date:* ${date}\n` +
                `⏰ *Preferred Time:* ${time}\n` +
                `💬 *Message:* ${message || 'None'}`;

            const whatsappUrl = `https://wa.me/916381757067?text=${encodeURIComponent(whatsappMessage)}`;

            // Optional background post to Google Sheet if configured
            if (window.GOOGLE_SHEET_URL && window.GOOGLE_SHEET_URL.startsWith('http')) {
                fetch(window.GOOGLE_SHEET_URL, {
                    method: 'POST',
                    body: new FormData(consultationForm)
                }).catch(err => console.log(err));
            }

            window.open(whatsappUrl, '_blank');
        });
    }

    // 6. Scroll Reveal Observer (Smooth 60fps Micro-Animations)
    const revealElements = document.querySelectorAll('.reveal');
    if (revealElements.length > 0) {
        if ('IntersectionObserver' in window) {
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, {
                root: null,
                threshold: 0.12,
                rootMargin: '0px 0px -40px 0px'
            });

            revealElements.forEach(el => revealObserver.observe(el));
        } else {
            revealElements.forEach(el => el.classList.add('active'));
        }
    }
});
