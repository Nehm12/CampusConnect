@extends('layouts.app')

@section('title', 'Détail de l\'annonce')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Breadcrumb --}}
        <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-6">
            <a href="{{ route('etudiant.dashboard') }}" class="hover:text-blue-600">📊 Tableau de bord</a>
            <span>→</span>
            <a href="{{ route('etudiant.announcements') }}" class="hover:text-blue-600">📢 Annonces</a>
            <span>→</span>
            <span class="text-gray-900 font-medium">Détail</span>
        </nav>

        {{-- Bouton retour --}}
        <div class="mb-6">
            <a href="{{ route('etudiant.announcements') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour aux annonces
            </a>
        </div>

        {{-- Contenu principal --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100">
            <div class="p-8">
                {{-- Header --}}
                <div class="border-b border-gray-200 pb-6 mb-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-700">
                            📢 Annonce Générale
                        </span>
                        <span class="text-gray-500 text-sm">
                            📅 Publié le {{ $announcement->created_at->format('d/m/Y à H:i') }}
                        </span>
                    </div>
                    
                    <h1 class="text-4xl font-bold text-gray-900 mb-6">
                        {{ $announcement->title }}
                    </h1>
                    
                    <div class="flex items-center text-sm text-gray-600">
                        <div class="flex items-center mr-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mr-3 text-white font-bold">
                                {{ substr($announcement->user->firstname ?? 'A', 0, 1) }}{{ substr($announcement->user->lastname ?? 'D', 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">
                                    {{ $announcement->user ? $announcement->user->firstname . ' ' . $announcement->user->lastname : 'Administrateur' }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ $announcement->user ? ($announcement->user->role == 'admin' ? 'Administrateur' : 'Enseignant') : 'Administrateur' }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Mis à jour {{ $announcement->updated_at->diffForHumans() }}
                        </div>
                    </div>
                </div>

                {{-- Contenu --}}
                <div class="prose prose-lg max-w-none">
                    <div class="text-gray-700 leading-relaxed text-lg whitespace-pre-line">
                        {{ $announcement->description }}
                    </div>
                </div>

                {{-- Actions --}}
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <button onclick="shareAnnouncement()" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 focus:ring-2 focus:ring-blue-500 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                                </svg>
                                Partager
                            </button>
                            
                            <button onclick="window.print()" 
                                    class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:ring-2 focus:ring-gray-500 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                </svg>
                                Imprimer
                            </button>
                        </div>
                        
                        <div class="text-sm text-gray-500">
                            ID: #{{ $announcement->id }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Annonces récentes --}}
        @if($recentAnnouncements->count() > 0)
        <div class="mt-8 bg-white rounded-xl shadow-lg border border-gray-100 p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                </svg>
                Autres annonces récentes
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($recentAnnouncements as $recent)
                    <a href="{{ route('etudiant.announcements.show', $recent->id) }}" 
                       class="block border border-gray-200 rounded-lg p-4 hover:shadow-md hover:border-blue-300 transition-all duration-200">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                Nouvelle
                            </span>
                            <span class="text-gray-500 text-xs">
                                {{ $recent->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">
                            {{ $recent->title }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                            {{ Str::limit($recent->description, 100) }}
                        </p>
                        <span class="text-blue-600 text-sm font-medium hover:text-blue-700 flex items-center">
                            Lire plus 
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<script>
function shareAnnouncement() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $announcement->title }}',
            text: '{{ Str::limit($announcement->description, 100) }}',
            url: window.location.href
        }).then(() => {
            console.log('Partage réussi');
        }).catch((error) => {
            console.log('Erreur de partage:', error);
            fallbackShare();
        });
    } else {
        fallbackShare();
    }
}

function fallbackShare() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        alert('✅ Lien copié dans le presse-papiers !');
    });
}
</script>
@endsection