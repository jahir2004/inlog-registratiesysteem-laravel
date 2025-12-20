<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title ?? __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container d-flex justify-content-center">
                        <div class="col-md-8">
                            <h2 class="my-3">{{ $title ?? 'User Details' }}</h2>

                            <div class="my-3 d-flex gap-3">
                                <a href="{{ route('praktijkmanagement.userroles') }}" class="btn btn-secondary btn-sm">Terug</a>
                                <a href="{{ route('praktijkmanagement.edit', $user->id) }}" class="btn btn-success btn-sm">Wijzig</a>
                            </div>

                            <table class="table table-striped table-bordered align-middle shadow-sm">
                                <tbody>
                                    <tr>
                                        <th style="width: 200px;">ID</th>
                                        <td>{{ $user->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Naam</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gebruikersrol</th>
                                        <td>{{ $user->rolename }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
