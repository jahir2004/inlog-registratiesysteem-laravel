@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold mb-4">{{ $title }}</h1>
                <p class="text-lg text-gray-600">Welkom in het tester dashboard. Hier kun je applicaties testen en bugs rapporteren.</p>
            </div>
        </div>
    </div>
</div>
@endsection

