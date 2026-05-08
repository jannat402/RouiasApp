@extends('layouts.app')

@section('title', 'Contacte')

@section('content')
<div class="max-w-7xl mx-auto mt-10 px-4">

    <div class="bg-white p-8 rounded-xl shadow border border-orange-200">
    <h1 class="text-4xl font-extrabold mb-8 text-orange-700">
        Contacta con nosotros
    </h1>
        <p class="text-gray-700 text-lg mb-6">
            Tens algun dubte, suggeriment o reclamació? Envia’ns un missatge.
        </p>

        <form action="#" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="font-semibold">Nom</label>
                <input type="text" class="w-full p-3 border border-orange-300 rounded-xl focus:ring focus:ring-orange-400">
            </div>

            <div>
                <label class="font-semibold">Email</label>
                <input type="email" class="w-full p-3 border border-orange-300 rounded-xl focus:ring focus:ring-orange-400">
            </div>

            <div>
                <label class="font-semibold">Missatge</label>
                <textarea class="w-full p-3 border border-orange-300 rounded-xl focus:ring focus:ring-orange-400"
                        rows="5"></textarea>
            </div>

            <button class="bg-orange-600 text-white px-6 py-3 rounded-xl shadow hover:bg-orange-700 transition font-bold">
                Enviar missatge
            </button>

        </form>

    </div>
</div>
@endsection
