<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Liste des Événements</h1>

        @include('components.flash-message')

        @if (auth()->user()->is_organizer)
            <a href="{{ route('events.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Créer un Événement</a>
        @endif

        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left">Titre</th>
                        <th class="px-6 py-3 text-left">Date</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($events as $event)
                        <tr>
                            <td class="px-6 py-4">{{ $event->title }}</td>
                            <td class="px-6 py-4">{{ $event->date_event }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('events.show', $event) }}" class="text-blue-500">Voir</a>

                                @if (auth()->user()->isOrganizerOf($event))
                                    <a href="{{ route('events.edit', $event->id) }}"
                                        class="btn btn-warning">Modifier</a>
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Voulez-vous vraiment supprimer cet événement ?')">Supprimer</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
