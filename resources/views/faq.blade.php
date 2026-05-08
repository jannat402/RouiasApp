@extends('layouts.app')

@section('title', 'Preguntes freqüents')

@section('content')

<div class="bg-white p-8 rounded-xl shadow border border-orange-200 space-y-6">
<h1 class="text-4xl font-extrabold mb-8 text-orange-700">
    Preguntas frecuentes
</h1>
    <div>
        <h3 class="text-xl font-bold text-orange-700">🛒 Com puc fer una compra?</h3>
        <p class="text-gray-700 mt-2">
            Afegeix els productes al carro i finalitza la compra des del botó “Finalitzar compra”.
        </p>
    </div>

    <div>
        <h3 class="text-xl font-bold text-orange-700">🚚 Quins són els temps d’enviament?</h3>
        <p class="text-gray-700 mt-2">
            Els enviaments triguen entre 24 i 72 hores laborables.
        </p>
    </div>

    <div>
        <h3 class="text-xl font-bold text-orange-700">💳 Quines formes de pagament accepteu?</h3>
        <p class="text-gray-700 mt-2">
            Acceptem targetes Visa, Mastercard i PayPal.
        </p>
    </div>

    <div>
        <h3 class="text-xl font-bold text-orange-700">📦 Puc retornar un producte?</h3>
        <p class="text-gray-700 mt-2">
            Sí, tens 14 dies naturals per fer una devolució.
        </p>
    </div>

</div>

@endsection
