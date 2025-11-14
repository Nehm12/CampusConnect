@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">📊 Dashboard Administrateur</h1>
            <p class="mt-2 text-gray-600">Vue d'ensemble de la plateforme CampusConnect</p>
        </div>

        {{-- Statistiques Principales --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            {{-- Total Utilisateurs --}}
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Utilisateurs</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-600 font-medium">{{ $stats['total_teachers'] }}</span>
                    <span class="text-gray-500 ml-1">enseignants</span>
                    <span class="mx-2">•</span>
                    <span class="text-blue-600 font-medium">{{ $stats['total_students'] }}</span>
                    <span class="text-gray-500 ml-1">étudiants</span>
                </div>
            </div>

            {{-- Total Annonces --}}
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Annonces</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_announcements'] }}</p>
                    </div>
                </div>
            </div>

            {{-- Total Catégories --}}
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-100 rounded-lg">
                        <svg class="h-8 w-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Catégories</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_categories'] }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-500">
                    <span>Actives sur la plateforme</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            {{-- Graphique Annonces par Catégorie --}}
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6">📊 Annonces par Catégorie</h2>
                <div class="h-80">
                    <canvas id="announcementsByCategoryChart"></canvas>
                </div>
            </div>

            {{-- Graphique Annonces par Catégorie (Pie) --}}
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6">🥧 Répartition des Annonces</h2>
                <div class="h-80 flex items-center justify-center">
                    <canvas id="announcementsPieChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Annonces Récentes --}}
            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900">📢 Annonces Récentes</h2>
                    <a href="{{ route('admin.announcements.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                        Voir tout →
                    </a>
                </div>
                <div class="p-6">
                    @forelse($recentAnnouncements as $announcement)
                        <div class="flex items-start space-x-3 py-3 border-b border-gray-100 last:border-0">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <span class="text-lg">📢</span>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">
                                    {{ $announcement->title }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    Par {{ $announcement->user->name }} • 
                                    {{ $announcement->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">Aucune annonce récente</p>
                    @endforelse
                </div>
            </div>

            {{-- Utilisateurs Récents --}}
            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900">👥 Nouveaux Utilisateurs</h2>
                    <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                        Voir tout →
                    </a>
                </div>
                <div class="p-6">
                    @forelse($recentUsers as $user)
                        <div class="flex items-center space-x-3 py-3 border-b border-gray-100 last:border-0">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900">
                                    {{ $user->name }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ $user->email }}
                                </p>
                            </div>
                            <span class="flex-shrink-0">
                                @if($user->role === 'admin')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">Admin</span>
                                @elseif($user->role === 'teacher')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Enseignant</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">Étudiant</span>
                                @endif
                            </span>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">Aucun utilisateur récent</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Données pour les graphiques
const categoryData = @json($announcementsByCategory);

// Graphique en barres - Annonces par Catégorie
const ctxBar = document.getElementById('announcementsByCategoryChart').getContext('2d');
new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: categoryData.map(item => item.name),
        datasets: [{
            label: 'Nombre d\'annonces',
            data: categoryData.map(item => item.count),
            backgroundColor: [
                'rgba(59, 130, 246, 0.8)',
                'rgba(16, 185, 129, 0.8)',
                'rgba(249, 115, 22, 0.8)',
                'rgba(139, 92, 246, 0.8)',
                'rgba(236, 72, 153, 0.8)',
            ],
            borderColor: [
                'rgb(59, 130, 246)',
                'rgb(16, 185, 129)',
                'rgb(249, 115, 22)',
                'rgb(139, 92, 246)',
                'rgb(236, 72, 153)',
            ],
            borderWidth: 2,
            borderRadius: 8,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                padding: 12,
                titleFont: {
                    size: 14
                },
                bodyFont: {
                    size: 13
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    font: {
                        size: 12
                    }
                },
                grid: {
                    color: 'rgba(0, 0, 0, 0.05)'
                }
            },
            x: {
                ticks: {
                    font: {
                        size: 12
                    }
                },
                grid: {
                    display: false
                }
            }
        }
    }
});

// Graphique en camembert - Répartition des Annonces
const ctxPie = document.getElementById('announcementsPieChart').getContext('2d');
new Chart(ctxPie, {
    type: 'doughnut',
    data: {
        labels: categoryData.map(item => item.name),
        datasets: [{
            data: categoryData.map(item => item.count),
            backgroundColor: [
                'rgba(59, 130, 246, 0.8)',
                'rgba(16, 185, 129, 0.8)',
                'rgba(249, 115, 22, 0.8)',
                'rgba(139, 92, 246, 0.8)',
                'rgba(236, 72, 153, 0.8)',
            ],
            borderColor: '#ffffff',
            borderWidth: 3,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 15,
                    font: {
                        size: 13
                    },
                    usePointStyle: true,
                    pointStyle: 'circle'
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                padding: 12,
                titleFont: {
                    size: 14
                },
                bodyFont: {
                    size: 13
                },
                callbacks: {
                    label: function(context) {
                        const label = context.label || '';
                        const value = context.parsed || 0;
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = ((value / total) * 100).toFixed(1);
                        return `${label}: ${value} (${percentage}%)`;
                    }
                }
            }
        }
    }
});
</script>
@endpush