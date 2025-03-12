<div class="mb-4">
    <label for="title" class="block text-gray-700">Titre</label>
    <input type="text" id="title" name="title" class="w-full border-gray-300 rounded-lg p-2"
        value="{{ old('title', $event->title) }}" required>
</div>

<div class="mb-4">
    <label for="description" class="block text-gray-700">Description</label>
    <textarea id="description" name="description" class="w-full border-gray-300 rounded-lg p-2" required>{{ old('description', $event->description) }}</textarea>
</div>

<div class="mb-4">
    <label for="date_event" class="block text-gray-700">Date de l'Événement</label>
    <input type="datetime-local" id="date_event" name="date_event" class="w-full border-gray-300 rounded-lg p-2"
        value="{{ old('date_event', $event->date_event) }}" required>
</div>
