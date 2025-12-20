<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title ?? __('Wijzig Gebruikersrol') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container d-flex justify-content-center">
                        <div class="col-md-8">
                            <h2 class="my-3">{{ $title ?? 'Wijzig Gebruikersrol' }}</h2>

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Sluiten"></button>
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Sluiten"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="my-3 d-flex gap-3">
                                <a href="{{ route('praktijkmanagement.userroles') }}" class="btn btn-secondary btn-sm">Terug</a>
                            </div>

                            <form action="{{ route('praktijkmanagement.update', $user->id) }}" method="POST" class="border rounded p-3">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Naam</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $user->name) }}"
                                        required
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        name="email"
                                        value="{{ old('email', $user->email) }}"
                                        required
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="rolename" class="form-label">Gebruikersrol</label>
                                    <select class="form-select" id="rolename" name="rolename" required>
                                        @foreach ($userroles as $role)
                                            @php
                                                $roleName = $role->rolename ?? $role->Rolename ?? $role->name ?? null;
                                            @endphp

                                            @if ($roleName)
                                                <option value="{{ $roleName }}" @selected(old('rolename', $user->rolename) === $roleName)>
                                                    {{ $roleName }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Opslaan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
