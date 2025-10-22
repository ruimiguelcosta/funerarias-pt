import './bootstrap';

// Cookie consent functionality
document.addEventListener('DOMContentLoaded', function() {
    const consent = localStorage.getItem('cookie-consent');
    const cookieConsent = document.getElementById('cookie-consent');
    
    if (!consent && cookieConsent) {
        cookieConsent.style.display = 'block';
    }
});

window.acceptCookies = function() {
    localStorage.setItem('cookie-consent', 'accepted');
    const cookieConsent = document.getElementById('cookie-consent');
    if (cookieConsent) {
        cookieConsent.style.display = 'none';
    }
};

window.declineCookies = function() {
    localStorage.setItem('cookie-consent', 'declined');
    const cookieConsent = document.getElementById('cookie-consent');
    if (cookieConsent) {
        cookieConsent.style.display = 'none';
    }
};

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Form validation and submission
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic form validation
            const inputs = form.querySelectorAll('input[required], textarea[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('border-red-500');
                } else {
                    input.classList.remove('border-red-500');
                }
            });
            
            if (isValid) {
                // Show success message
                alert('Formulário enviado com sucesso!');
                form.reset();
            } else {
                alert('Por favor, preencha todos os campos obrigatórios.');
            }
        });
    });
});