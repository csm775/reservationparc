<h1 class="text-2xl font-bold mb-4">Ajouter une activité</h1>

<form method="post" class="space-y-4">
    <input type="text" name="nom" placeholder="Nom" class="border p-2 w-full" required>
    <input type="number" name="type_id" placeholder="Type ID" class="border p-2 w-full" required>
    <input type="number" name="places_disponibles" placeholder="Places" class="border p-2 w-full" required>
    <input type="text" name="description" placeholder="Description" class="border p-2 w-full" required>
    <input type="datetime-local" name="datetime_debut" class="border p-2 w-full" required>
    <input type="number" name="duree" placeholder="Durée (minutes)" class="border p-2 w-full" required>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Ajouter</button>
</form>
