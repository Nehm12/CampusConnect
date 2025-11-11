{{-- resources/views/layouts/partials/footer.blade.php --}}
<footer class="bg-gray-900 text-gray-300">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            
            {{-- Logo et description --}}
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">CC</span>
                    </div>
                    <span class="text-xl font-bold text-white">
                        Campus<span class="text-blue-400">Connect</span>
                    </span>
                </div>
                <p class="text-gray-400 leading-relaxed mb-4 max-w-md">
                    Plateforme universitaire conçue pour faciliter la communication et la gestion des ressources du campus. Développée par les étudiants, pour les étudiants.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-9 h-9 bg-gray-800 hover:bg-blue-600 rounded-full flex items-center justify-center transition-colors duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-9 h-9 bg-gray-800 hover:bg-blue-600 rounded-full flex items-center justify-center transition-colors duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-9 h-9 bg-gray-800 hover:bg-blue-600 rounded-full flex items-center justify-center transition-colors duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm4.441 16.892c-2.102.144-6.784.144-8.883 0C5.282 16.736 5.017 15.622 5 12c.017-3.629.285-4.736 2.558-4.892 2.099-.144 6.782-.144 8.883 0C18.718 7.264 18.982 8.378 19 12c-.018 3.629-.285 4.736-2.559 4.892zM10 9.658l4.917 2.338L10 14.342V9.658z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Liens rapides --}}
            <div>
                <h3 class="text-white font-semibold text-lg mb-4">Liens rapides</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('welcome') }}" class="hover:text-blue-400 transition-colors duration-200">
                            Accueil
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="hover:text-blue-400 transition-colors duration-200">
                            À propos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="hover:text-blue-400 transition-colors duration-200">
                            Contact
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="hover:text-blue-400 transition-colors duration-200">
                            Connexion
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Informations légales --}}
            <div>
                <h3 class="text-white font-semibold text-lg mb-4">Informations</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="hover:text-blue-400 transition-colors duration-200">
                            Mentions légales
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-blue-400 transition-colors duration-200">
                            Politique de confidentialité
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-blue-400 transition-colors duration-200">
                            Conditions d'utilisation
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-blue-400 transition-colors duration-200">
                            FAQ
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="border-t border-gray-800 mt-8 pt-8 text-center">
            <p class="text-gray-400 text-sm">
                © {{ date('Y') }} CampusConnect - Tous droits réservés. 
                <span class="text-gray-500">|</span> 
                Développé avec <span class="text-red-500">❤️</span> par l'équipe CampusConnect
            </p>
        </div>
    </div>
</footer>