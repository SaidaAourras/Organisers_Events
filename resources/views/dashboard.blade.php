<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex h-screen bg-gray-100">
                        <!-- Sidebar -->
                        <aside class="w-64 bg-white shadow-md p-6">
                            <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
                            <nav class="mt-6">
                                <ul>
                                    <li>
                                        <a href="{{ route('events.index') }}"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded">📅 Mes
                                            Événements</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('profile.edit') }}"
                                            class="block px-4 py-2 mt-2 text-gray-700 hover:bg-gray-200 rounded">⚙️ Mon
                                            Profil</a>
                                    </li>
                                </ul>
                            </nav>
                        </aside>

                        <!-- Main Content -->
                        <main class="flex-1 p-6">
                            <h1 class="text-3xl font-bold text-gray-800">Bienvenue, {{ auth()->user()->name }} 👋</h1>

                            <!-- Stats Cards -->
                            <div class="grid grid-cols-3 gap-6 mt-6">
                                <div class="bg-white p-6 rounded-lg shadow-md">
                                    <h2 class="text-xl font-semibold text-gray-700">Total Événements</h2>
                                    <p class="text-3xl font-bold text-blue-500">{{ auth()->user()->events->count() }}
                                    </p>
                                </div>
                                <div class="bg-white p-6 rounded-lg shadow-md">
                                    <h2 class="text-xl font-semibold text-gray-700">Événements à Venir</h2>
                                    <p class="text-3xl font-bold text-green-500">
                                        {{ auth()->user()->events->where('date_event', '>=', now())->count() }}</p>
                                </div>
                                <div class="bg-white p-6 rounded-lg shadow-md">
                                    <h2 class="text-xl font-semibold text-gray-700">Places Disponibles</h2>
                                    <p class="text-3xl font-bold text-red-500">
                                        {{ auth()->user()->events->sum(fn($event) => $event->remainingPlaces()) }}
                                    </p>
                                </div>
                            </div>

                            <!-- Events Table -->
                            <div class="bg-white p-6 mt-6 rounded-lg shadow-md">
                                <h2 class="text-xl font-semibold text-gray-800 mb-4">📋 Liste des Événements</h2>
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th class="p-3">Titre</th>
                                            <th class="p-3">Date</th>
                                            <th class="p-3">Places restantes</th>
                                            <th class="p-3">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (auth()->user()->events as $event)
                                            <tr class="border-b">
                                                <td class="p-3">{{ $event->title }}</td>
                                                <td class="p-3">{{ $event->date_event }}</td>
                                                <td class="p-3 text-green-600 font-semibold">
                                                    {{-- {{ $event->remainingPlaces() }} --}}
                                                </td>
                                                <td class="p-3">
                                                    <a href="{{ route('events.show', $event->id) }}"
                                                        class="text-blue-500 hover:underline">Voir</a>
                                                    {{-- @if (auth()->user()->isOrganizer($event->id)) --}}
                                                    <a href="{{ route('events.edit', $event->id) }}"
                                                        class="text-yellow-500 hover:underline mx-2">Modifier</a>
                                                    <form action="{{ route('events.destroy', $event->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-500 hover:underline">Supprimer</button>
                                                    </form>
                                                    {{-- @endif --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
