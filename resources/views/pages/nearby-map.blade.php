@extends('layouts.app')

@section('content')
<div class="pt-20 min-h-screen bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Voltar
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h1 class="font-playfair text-3xl md:text-4xl font-bold text-purple-700 mb-2">
                    Funerárias Próximas de Si
                </h1>
                <p class="text-gray-600" id="location-status">
                    A carregar a sua localização...
                </p>
            </div>

            <div id="map-container" class="relative">
                <div id="map" style="height: 70vh;" class="w-full"></div>
                
                <div id="loading-overlay" class="absolute inset-0 bg-white bg-opacity-90 flex items-center justify-center z-10">
                    <div class="text-center">
                        <div class="inline-block animate-spin rounded-full h-16 w-16 border-b-2 border-purple-600 mb-4"></div>
                        <p class="text-gray-600 text-lg">A carregar mapa e funerárias...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="entity-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 pointer-events-none">
    <div class="bg-white rounded-lg shadow-2xl overflow-hidden pointer-events-auto animate-slide-up border-2 border-purple-100 max-w-md w-full">
        <div class="relative">
            <img id="modal-image" src="" alt="" class="w-full h-40 object-cover">
            <button onclick="closeModal()" class="absolute top-2 right-2 bg-white rounded-full p-1.5 shadow-lg hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-5">
            <h2 id="modal-title" class="font-playfair text-xl font-bold text-purple-700 mb-3"></h2>
            <div class="space-y-2 mb-4">
                <div class="flex items-center text-gray-600 text-sm">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                    <span id="modal-city"></span>
                </div>
                <div id="modal-phone-container" class="flex items-center text-gray-600 text-sm">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                    </svg>
                    <a id="modal-phone" href="" class="hover:text-purple-600"></a>
                </div>
                <div class="flex items-center text-gray-600 text-sm">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z" clip-rule="evenodd"></path>
                    </svg>
                    <span id="modal-distance" class="font-semibold text-purple-600"></span>
                </div>
            </div>
            <a id="modal-link" href="" class="block w-full bg-gradient-to-r from-purple-600 to-purple-500 text-white text-center py-2.5 rounded-lg font-semibold hover:opacity-90 transition-all duration-300 text-sm">
                Ver Detalhes Completos
            </a>
        </div>
    </div>
</div>

<link href="https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.js"></script>

<script>
    mapboxgl.accessToken = '{{ $mapboxApiKey }}';
    
    let map;
    let userMarker;
    let entityMarkers = [];
    
    const mapboxConfig = {
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [-8.6291, 41.1579],
        zoom: 11
    };

    function initMap(userLat, userLng) {
        mapboxConfig.center = [userLng, userLat];
        map = new mapboxgl.Map(mapboxConfig);

        map.addControl(new mapboxgl.NavigationControl());

        userMarker = new mapboxgl.Marker({ color: '#7c3aed' })
            .setLngLat([userLng, userLat])
            .setPopup(new mapboxgl.Popup().setHTML('<div class="text-center font-semibold">Você está aqui</div>'))
            .addTo(map);

        loadEntities(userLat, userLng);
    }

    async function loadEntities(lat, lng) {
        const url = `/api/map-funeral-homes?latitude=${lat}&longitude=${lng}`;
        
        fetch(url)
            .then(response => response.json())
            .then(data => {
                document.getElementById('loading-overlay').classList.add('hidden');
                
                if (data.success && data.entities.length > 0) {
                    document.getElementById('location-status').textContent = 
                        `Encontradas ${data.count} funerárias num raio de 50km`;
                    
                    data.entities.forEach(entity => {
                        addEntityMarker(entity);
                    });
                } else {
                    document.getElementById('location-status').textContent = 
                        'Nenhuma funerária encontrada num raio de 50km';
                }
            })
            .catch(error => {
                console.error('Erro ao carregar funerárias:', error);
                document.getElementById('loading-overlay').classList.add('hidden');
                document.getElementById('location-status').textContent = 
                    'Erro ao carregar funerárias próximas';
            });
    }

    function addEntityMarker(entity) {
        const el = document.createElement('div');
        el.className = 'entity-marker';
        el.style.backgroundImage = 'url(/images/marker-funeral-home.png)';
        el.style.width = '32px';
        el.style.height = '32px';
        el.style.backgroundSize = '100%';
        el.style.cursor = 'pointer';
        el.innerHTML = '<div style="width: 32px; height: 32px; background-color: #16a34a; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3);"></div>';

        const marker = new mapboxgl.Marker(el)
            .setLngLat([entity.longitude, entity.latitude])
            .addTo(map);

        el.addEventListener('click', () => {
            showEntityModal(entity);
        });

        entityMarkers.push(marker);
    }

    function showEntityModal(entity) {
        document.getElementById('modal-image').src = entity.image;
        document.getElementById('modal-image').alt = entity.title;
        document.getElementById('modal-title').textContent = entity.title;
        document.getElementById('modal-city').textContent = entity.city;
        
        if (entity.phone) {
            document.getElementById('modal-phone-container').classList.remove('hidden');
            document.getElementById('modal-phone').textContent = entity.phone;
            document.getElementById('modal-phone').href = `tel:${entity.phone}`;
        } else {
            document.getElementById('modal-phone-container').classList.add('hidden');
        }
        
        document.getElementById('modal-distance').textContent = `${entity.distance} km de distância`;
        document.getElementById('modal-link').href = entity.url;
        
        document.getElementById('entity-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('entity-modal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const storedLocation = localStorage.getItem('user-location');
        
        if (storedLocation) {
            const location = JSON.parse(storedLocation);
            initMap(location.latitude, location.longitude);
        } else {
            if ('geolocation' in navigator) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const locationData = {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude,
                            accuracy: position.coords.accuracy,
                            timestamp: new Date().toISOString()
                        };
                        
                        localStorage.setItem('user-location', JSON.stringify(locationData));
                        initMap(locationData.latitude, locationData.longitude);
                    },
                    (error) => {
                        console.error('Erro ao obter localização:', error);
                        document.getElementById('loading-overlay').classList.add('hidden');
                        document.getElementById('location-status').textContent = 
                            'Não foi possível obter a sua localização. Por favor, permita o acesso à localização.';
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            } else {
                document.getElementById('loading-overlay').classList.add('hidden');
                document.getElementById('location-status').textContent = 
                    'O seu navegador não suporta geolocalização.';
            }
        }
    });
</script>

<style>
    .mapboxgl-popup-content {
        padding: 8px 12px;
        border-radius: 8px;
    }

    @keyframes slide-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slide-up {
        animation: slide-up 0.3s ease-out;
    }

    #funeral-home-modal.hidden {
        display: none !important;
    }
</style>
@endsection

