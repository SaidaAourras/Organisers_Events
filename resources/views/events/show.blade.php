<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-3xl font-bold mb-2">{{ $event->title }}</h1>
        <p class="text-gray-700">{{ $event->description }}</p>
        <p class="text-gray-500 mt-2"><strong>Date :</strong> {{ $event->date_event }}</p>

        <h3 class="mt-6 text-xl font-semibold">Participants</h3>
        <ul class="list-disc ml-6">
            @foreach ($event->users as $user)
                <li>{{ $user->name }} ({{ $user->pivot->isOrganizer ? 'Organisateur' : 'Participant' }})</li>
            @endforeach
        </ul>

        <div class="mt-4">
            <a href="{{ route('events.index') }}" class="text-blue-500">Retour</a>

            @if (auth()->user()->isOrganizerOf($event))
                <a href="{{ route('events.edit', $event->id) }}" class="text-warning">Modifier</a>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-danger"
                        onclick="return confirm('Voulez-vous vraiment supprimer cet événement ?')">Supprimer</button>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
