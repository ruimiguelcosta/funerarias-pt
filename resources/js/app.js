import './bootstrap';

// Cookie consent functionality
document.addEventListener('DOMContentLoaded', function() {
    const consent = localStorage.getItem('cookie-consent');
    const cookieConsent = document.getElementById('cookie-consent');
    
    if (!consent && cookieConsent) {
        cookieConsent.style.display = 'block';
    }
    
    initGeolocation();
});

function initGeolocation() {
    const storedLocation = localStorage.getItem('user-location');
    
    if (storedLocation) {
        const location = JSON.parse(storedLocation);
        console.log('Localização guardada:', location);
        
        if (document.getElementById('nearby-funeral-homes-section')) {
            loadNearbyFuneralHomes(location.latitude, location.longitude);
        }
        return;
    }
    
    if ('geolocation' in navigator) {
        setTimeout(() => {
            requestGeolocationPermission();
        }, 2000);
    }
}

function requestGeolocationPermission() {
    navigator.geolocation.getCurrentPosition(
        (position) => {
            const locationData = {
                latitude: position.coords.latitude,
                longitude: position.coords.longitude,
                accuracy: position.coords.accuracy,
                timestamp: new Date().toISOString()
            };
            
            localStorage.setItem('user-location', JSON.stringify(locationData));
            console.log('Localização guardada com sucesso:', locationData);
            
            window.dispatchEvent(new CustomEvent('locationGranted', { 
                detail: locationData 
            }));
            
            loadNearbyFuneralHomes(locationData.latitude, locationData.longitude);
        },
        (error) => {
            console.log('Permissão de localização negada ou erro:', error.message);
            localStorage.setItem('user-location-denied', 'true');
        },
        {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        }
    );
}

window.getUserLocation = function() {
    const storedLocation = localStorage.getItem('user-location');
    return storedLocation ? JSON.parse(storedLocation) : null;
};

window.clearUserLocation = function() {
    localStorage.removeItem('user-location');
    localStorage.removeItem('user-location-denied');
    console.log('Localização removida');
};

async function loadNearbyFuneralHomes(latitude, longitude) {
    const section = document.getElementById('nearby-funeral-homes-section');
    if (!section) return;

    const container = document.getElementById('nearby-funeral-homes-container');
    const loadingDiv = document.getElementById('nearby-loading');
    
    loadingDiv.classList.remove('hidden');
    
    const url = `/api/nearby-funeral-homes?latitude=${latitude}&longitude=${longitude}`;
    
    fetch(url)
        .then(response => response.json())
        .then(data => {
            loadingDiv.classList.add('hidden');
            
            if (data.success && data.funeral_homes.length > 0) {
                section.classList.remove('hidden');
                renderNearbyFuneralHomes(data.funeral_homes, container);
            } else {
                section.classList.add('hidden');
            }
        })
        .catch(error => {
            console.error('Erro ao carregar funerárias próximas:', error);
            loadingDiv.classList.add('hidden');
            section.classList.add('hidden');
        });
}

function renderNearbyFuneralHomes(funeralHomes, container) {
    container.innerHTML = funeralHomes.map(home => `
        <a href="${home.url}" class="block bg-white rounded-lg shadow-soft hover:shadow-elegant transition-all duration-300 overflow-hidden">
            <div class="relative h-48 overflow-hidden">
                <img src="${home.image}" 
                     alt="${home.title}"
                     class="w-full h-full object-cover transition-transform duration-300 hover:scale-110"
                     loading="lazy">
                <div class="absolute top-3 right-3 bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                    ${home.distance} km
                </div>
            </div>
            <div class="p-6">
                <h3 class="font-playfair text-xl font-semibold text-purple-700 mb-2">${home.title}</h3>
                <p class="text-gray-600 text-sm mb-3">${home.description}</p>
                <div class="flex items-center justify-between text-sm text-gray-500">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                        ${home.city}
                    </span>
                    ${home.total_score ? `
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        ${home.total_score} (${home.reviews_count})
                    </span>
                    ` : ''}
                </div>
            </div>
        </a>
    `).join('');
}

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