{{-- resources/views/contact.blade.php --}}
@extends('layouts.guest')

@section('title', 'Contact - CampusConnect')



@section('content')
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Contactez-nous</h1>
            <p class="text-gray-600 text-lg md:text-xl">
                Pour toute question ou suggestion, notre équipe est à votre écoute.
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 border border-gray-100">
            <form action="" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Nom</label>
                    <input type="text" id="name" name="name" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div>
                    <label for="message" class="block text-gray-700 font-semibold mb-2">Message</label>
                    <textarea id="message" name="message" rows="6" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-full font-semibold text-lg shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
                        Envoyer
                    </button>
                </div>
            </form>

            <div class="mt-12 text-center text-gray-600">
                <p>Email : <a href="mailto:support@campusconnect.com" class="text-blue-600 hover:underline">support@campusconnect.com</a></p>
                <p>Téléphone : +229 99 99 99 99</p>
                <p>Adresse : Campus Universitaire, Bénin</p>
            </div>
        </div>
    </div>
</section>
@endsection
