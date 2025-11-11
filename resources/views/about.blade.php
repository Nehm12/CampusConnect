{{-- resources/views/about.blade.php --}}
@extends('layouts.guest')

@section('title', 'À propos - CampusConnect')


@section('content')
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">À propos de CampusConnect</h1>
            <p class="text-gray-600 text-lg md:text-xl">Notre initiative pour faciliter la vie universitaire et centraliser la communication sur le campus.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <p class="text-gray-700 text-lg leading-relaxed">
                    <strong>CampusConnect</strong> est une plateforme interne visant à simplifier l'accès aux informations universitaires, aux annonces importantes et aux réservations de salles ou de matériel.
                </p>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Développée par les étudiants, pour les étudiants, elle centralise toutes les ressources essentielles et favorise l’échange entre étudiants, enseignants et services administratifs.
                </p>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Notre objectif : rendre la vie universitaire plus fluide, interactive et accessible pour toute la communauté du campus.
                </p>
            </div>

            <div class="relative">
                <img src="{{ asset('images/about-campus.jpg') }}" alt="Campus" class="rounded-2xl shadow-lg object-cover w-full h-full">
            </div>
        </div>

        <div class="mt-20 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Pourquoi choisir CampusConnect ?</h2>
            <div class="flex flex-wrap justify-center gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 max-w-xs">
                    <div class="text-4xl mb-4">📢</div>
                    <h3 class="text-xl font-semibold mb-2">Annonces en temps réel</h3>
                    <p class="text-gray-600">Restez informé des examens, soutenances et activités du campus.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 max-w-xs">
                    <div class="text-4xl mb-4">🏫</div>
                    <h3 class="text-xl font-semibold mb-2">Réservation simplifiée</h3>
                    <p class="text-gray-600">Réservez salles et matériels rapidement, directement depuis votre dashboard.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 max-w-xs">
                    <div class="text-4xl mb-4">👥</div>
                    <h3 class="text-xl font-semibold mb-2">Collaboration</h3>
                    <p class="text-gray-600">Favorisez les échanges entre étudiants, enseignants et administration.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
