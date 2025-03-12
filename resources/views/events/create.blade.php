<x-app-layout>
    <div class="container max-w-7xl mx-auto mt-6 p-6 bg-white shadow overflow-hidden sm:rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">Créer un Événement</h1>

        <form action="{{ route('events.store') }}" method="POST">
            @csrf
            @include('events._form', ['event' => new \App\Models\Event()])
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
</x-app-layout>
