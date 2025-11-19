<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard - CampusConnect')</title>

    {{-- ✅ Favicon SVG inline (fonctionne immédiatement) --}}
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' fill='%232563eb' rx='20'/><text x='50' y='70' font-size='55' font-weight='bold' fill='white' text-anchor='middle' font-family='Arial'>CC</text></svg>">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">
    
    {{-- Navbar authentifié --}}
    @include('layouts.partials.header')

    {{-- Layout principal avec sidebar --}}
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        @include('layouts.partials.sidebar')
        
        {{-- Contenu principal --}}
        <main class="flex-1 p-6">
            {{-- En-tête de page (optionnel) --}}
            @hasSection('page-header')
                <div class="mb-6">
                    @yield('page-header')
                </div>
            @endif
            
            {{-- Contenu de la page --}}
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>