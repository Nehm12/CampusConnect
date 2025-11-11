@extends('layouts.guest')

@section('title', 'Accueil - CampusConnect')

@section('content')
<!-- Hero Section / Bannière principale -->
<section class="relative bg-gradient-to-br from-blue-600 to-blue-800 text-white overflow-hidden min-h-[90vh] flex items-center">
    <div class="absolute inset-0 opacity-10">
        <img src="{{ asset('images/banner-campus.jpg') }}" alt="Campus" class="w-full h-full object-cover">
    </div>
    
    <div class="relative container mx-auto px-4 py-20 text-center z-10">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6 animate-fade-in">
                <span class="inline-block text-blue-200 text-sm font-semibold uppercase tracking-wide mb-4">
                    Plateforme universitaire
                </span>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-bold mb-6 animate-slide-up">
                🎓 Bienvenue sur <span class="text-yellow-300">CampusConnect</span>
            </h1>
            
            <p class="text-xl md:text-2xl text-blue-100 mb-10 animate-slide-up" style="animation-delay: 0.2s;">
                Le portail qui facilite la vie universitaire !
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-slide-up" style="animation-delay: 0.4s;">
                <a href="#features" class="bg-white text-blue-600 hover:bg-blue-50 px-8 py-4 rounded-full font-semibold text-lg shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
                    Découvrir
                </a>
                <a href="{{ route('login') }}" class="bg-blue-700 hover:bg-blue-800 px-8 py-4 rounded-full font-semibold text-lg border-2 border-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
                    Se connecter
                </a>
            </div>
        </div>
    </div>
    
    <!-- Decoration wave -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z" fill="white"/>
        </svg>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-20 bg-white scroll-mt-20">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                Fonctionnalités principales
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Découvrez les outils qui simplifient votre quotidien universitaire
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Feature Card 1 -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 border border-gray-100 hover:-translate-y-2 group">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6 mx-auto transition-transform duration-300 group-hover:scale-110">
                    <span class="text-4xl">📢</span>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">
                    Annonces universitaires
                </h3>
                <p class="text-gray-600 text-center leading-relaxed">
                    Retrouvez toutes les informations importantes : examens, soutenances, événements et bien plus encore.
                </p>
            </div>
            
            <!-- Feature Card 2 -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 border border-gray-100 hover:-translate-y-2 group">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 mx-auto transition-transform duration-300 group-hover:scale-110">
                    <span class="text-4xl">🏫</span>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">
                    Réservation de salles
                </h3>
                <p class="text-gray-600 text-center leading-relaxed">
                    Réservez facilement une salle de cours ou du matériel en quelques clics seulement.
                </p>
            </div>
            
            <!-- Feature Card 3 -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 border border-gray-100 hover:-translate-y-2 group">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6 mx-auto transition-transform duration-300 group-hover:scale-110">
                    <span class="text-4xl">👥</span>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">
                    Espace collaboratif
                </h3>
                <p class="text-gray-600 text-center leading-relaxed">
                    Favorisez les échanges entre étudiants, enseignants et administration du campus.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 border border-gray-100">
                <div class="text-center mb-8">
                    <div class="inline-block bg-blue-100 rounded-full p-4 mb-6">
                        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">
                        À propos de CampusConnect
                    </h2>
                </div>
                
                <div class="text-center max-w-none">
                    <p class="text-gray-700 text-lg leading-relaxed mb-6">
                        <strong>CampusConnect</strong> est une initiative interne visant à centraliser la communication et les ressources du campus.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8">
                        Développée par les étudiants, pour les étudiants, notre plateforme répond aux besoins réels de la communauté universitaire.
                    </p>
                    
                    <div class="flex flex-wrap justify-center gap-8 md:gap-12 mt-8">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-blue-600 mb-2">1000+</div>
                            <div class="text-gray-600">Étudiants</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-blue-600 mb-2">50+</div>
                            <div class="text-gray-600">Enseignants</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-blue-600 mb-2">24/7</div>
                            <div class="text-gray-600">Disponibilité</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">
            Prêt à rejoindre CampusConnect ?
        </h2>
        <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
            Créez votre compte dès maintenant et profitez de tous les avantages de notre plateforme
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-blue-50 px-8 py-4 rounded-full font-semibold text-lg shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
                Créer un compte
            </a>
            <a href="{{ route('login') }}" class="bg-transparent border-2 border-white hover:bg-white hover:text-blue-600 px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300">
                J'ai déjà un compte
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Smooth scroll for anchor links
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
</script>
@endpush