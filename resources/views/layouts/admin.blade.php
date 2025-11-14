<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - Gestion Annonces Université</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        [x-cloak] { display: none; }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-indigo-900 to-indigo-800 text-white fixed h-full shadow-xl">
            <div class="p-6 border-b border-indigo-700">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    Administrateur
                </h1>
            </div>
            
            <nav class="mt-6 px-3">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 mb-2 rounded-lg transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-700 shadow-lg' : 'hover:bg-indigo-700/50' }}">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.annonces.index') }}" 
                   class="flex items-center px-4 py-3 mb-2 rounded-lg transition-all {{ request()->routeIs('admin.annonces.*') ? 'bg-indigo-700 shadow-lg' : 'hover:bg-indigo-700/50' }}">
                    <i class="fas fa-bullhorn w-5"></i>
                    <span class="ml-3">Annonces</span>
                </a>
                
                <a href="#" class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-indigo-700/50 transition-all">
                    <i class="fas fa-folder w-5"></i>
                    <span class="ml-3">Réservations</span>
                </a>
                
                <a href="{{ route('admin.users.index') }}" 
                    class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-indigo-700/50 transition-all">
                    <i class="fas fa-users w-5"></i>
                    <span class="ml-3">Utilisateurs</span>
                </a>
                
            </nav>

            <div class="absolute bottom-0 w-64 p-4 border-t border-indigo-700">
                <div class="flex items-center px-4 py-2">
                    <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-xs text-indigo-300">Administrateur</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Header -->
            <header class="bg-white shadow-sm sticky top-0 z-10">
                <div class="flex justify-between items-center px-8 py-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">@yield('page-title')</h2>
                        <p class="text-sm text-gray-500 mt-1">@yield('page-subtitle')</p>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <button class="relative p-2 text-gray-600 hover:text-gray-800">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="flex items-center text-gray-700 hover:text-red-600 transition">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                <span>Déconnexion</span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Flash Messages -->
            @if(session('success') || session('error') || session('warning') || $errors->any())
            <div class="px-8 py-4">
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm mb-4 flex items-center">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                        <span class="text-green-800">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm mb-4 flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
                        <span class="text-red-800">{{ session('error') }}</span>
                    </div>
                @endif

                @if(session('warning'))
                    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg shadow-sm mb-4 flex items-center">
                        <i class="fas fa-exclamation-triangle text-yellow-500 text-xl mr-3"></i>
                        <span class="text-yellow-800">{{ session('warning') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm mb-4">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3 mt-0.5"></i>
                            <div class="flex-1">
                                <p class="font-semibold text-red-800 mb-2">Erreurs de validation :</p>
                                <ul class="list-disc list-inside text-red-700 space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @endif

            <!-- Page Content -->
            <main class="px-8 py-6">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="px-8 py-4 text-center text-gray-500 text-sm border-t mt-8">
                <p>&copy; {{ date('Y') }} Campus Connect - Tous droits réservés</p>
            </footer>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
