<x-app-layout>
    <div class="container max-w-7xl mx-auto mt-6 p-6 bg-white shadow overflow-hidden sm:rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">Modifier l'Événement</h1>
        <form action="{{ route('events.update', $event) }}" method="POST">
            @csrf
            @method('PUT')
            @include('events._form', ['event' => $event])
            <button type="submit" class="btn btn-success">Modifier</button>
        </form>
    </div>
</x-app-layout>
