<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-bing-verify />
    
    <!-- SEO Meta Tags -->
    <x-seo-meta-tags :page="$seoPage ?? 'home'" :data="$seoData ?? []" />
    
    <!-- Fonts Optimization -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Preload critical font weights -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap"></noscript>
    
    <!-- Load non-critical font weights asynchronously -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&display=swap"></noscript>
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css'])
    
    <!-- Custom CSS -->
    <style>
        :root {
            --background: 40 20% 97%;
            --foreground: 280 15% 15%;
            --card: 0 0% 100%;
            --card-foreground: 280 15% 15%;
            --popover: 0 0% 100%;
            --popover-foreground: 280 15% 15%;
            --primary: 270 50% 35%;
            --primary-foreground: 0 0% 98%;
            --primary-light: 270 45% 65%;
            --secondary: 45 50% 75%;
            --secondary-foreground: 280 15% 15%;
            --secondary-dark: 45 40% 60%;
            --muted: 280 10% 92%;
            --muted-foreground: 280 8% 45%;
            --accent: 160 30% 65%;
            --accent-foreground: 280 15% 15%;
            --accent-dark: 160 35% 45%;
            --destructive: 0 72% 51%;
            --destructive-foreground: 0 0% 98%;
            --border: 280 12% 88%;
            --input: 280 12% 88%;
            --ring: 270 50% 35%;
            --radius: 0.75rem;
            --gradient-primary: linear-gradient(135deg, hsl(270 50% 35%), hsl(270 45% 50%));
            --gradient-secondary: linear-gradient(135deg, hsl(45 50% 75%), hsl(45 60% 85%));
            --gradient-hero: linear-gradient(135deg, hsl(270 50% 25% / 0.95), hsl(270 45% 35% / 0.9));
            --gradient-card: linear-gradient(145deg, hsl(0 0% 100%), hsl(280 10% 98%));
            --shadow-elegant: 0 10px 40px -10px hsl(270 50% 35% / 0.2);
            --shadow-soft: 0 4px 20px hsl(280 10% 50% / 0.1);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dark {
            --background: 280 20% 10%;
            --foreground: 40 20% 95%;
            --card: 280 15% 13%;
            --card-foreground: 40 20% 95%;
            --popover: 280 15% 13%;
            --popover-foreground: 40 20% 95%;
            --primary: 270 45% 65%;
            --primary-foreground: 280 15% 10%;
            --secondary: 45 40% 50%;
            --secondary-foreground: 280 15% 10%;
            --muted: 280 15% 20%;
            --muted-foreground: 280 10% 65%;
            --accent: 160 25% 50%;
            --accent-foreground: 40 20% 95%;
            --destructive: 0 62% 45%;
            --destructive-foreground: 40 20% 95%;
            --border: 280 15% 25%;
            --input: 280 15% 25%;
            --ring: 270 45% 65%;
        }

        * {
            border-color: hsl(var(--border));
        }

        body {
            background-color: hsl(var(--background));
            color: hsl(var(--foreground));
            font-family: system-ui, -apple-system, sans-serif;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        .gradient-primary {
            background: var(--gradient-primary);
        }
        
        .gradient-secondary {
            background: var(--gradient-secondary);
        }
        
        .gradient-hero {
            background: var(--gradient-hero);
        }
        
        .gradient-card {
            background: var(--gradient-card);
        }
        
        .shadow-elegant {
            box-shadow: var(--shadow-elegant);
        }
        
        .shadow-soft {
            box-shadow: var(--shadow-soft);
        }
        
        .transition-smooth {
            transition: var(--transition-smooth);
        }

        .font-playfair {
            font-family: 'Playfair Display', 'Times New Roman', Times, serif;
            font-display: swap;
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
    </style>
</head>
<body>
    @include('components.navbar')
    
    <main class="min-h-screen">
        @yield('content')
    </main>
    
    @include('components.footer')
    @include('components.cookie-consent')
    <x-statcounter />
    
    @vite(['resources/js/app.js'])
</body>
</html>
