<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title ?? __('Gebruikersrollen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container d-flex justify-content-center">
                        <div class="col-md-10">
                            <h2 class="my-3">{{ $title ?? 'Gebruikersrollen' }}</h2>

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Sluiten"></button>
                                </div>
                                <meta http-equiv="refresh" content="3;url={{ route('praktijkmanagement.index') }}">
                            @elseif (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Sluiten"></button>
                                </div>
                                <meta http-equiv="refresh" content="3;url={{ route('praktijkmanagement.index') }}">
                            @endif

                            <div class="my-3 d-flex gap-3">
                                {{-- <a href="{{ route('praktijkmanagement.create') }}" class="btn btn-primary btn-sm">Nieuw allergenen</a> --}}
                                <a href="{{ route('welcome') }}" class="btn btn-secondary btn-sm me-auto">Terug</a>
                            </div>

                            <table class="table table-striped table-bordered align-middle shadow-sm">
                                <thead>
                                    <tr>
                                        <th>Naam</th>
                                        <th>Email</th>
                                        <th>Gebruikersrol</th>
                                        <th class="text-center">Verwijder</th>
                                        <th class="text-center">Wijzig</th>
                                        <th class="text-center">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->rolename }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('praktijkmanagement.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze user wilt verwijderen?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Verwijderen</button>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('praktijkmanagement.edit', $user->id) }}" class="btn btn-success btn-sm">Wijzig</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('praktijkmanagement.show', $user->id) }}" class="btn btn-warning btn-sm">Details</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">Geen allergenen beschikbaar</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
