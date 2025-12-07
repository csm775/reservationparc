<h1 class="text-2xl font-bold mb-4">Modifier l'activité</h1>

<form method="post" class="space-y-4">
    <input type="text" name="nom" value="<?= $activity['nom'] ?>" class="border p-2 w-full" required>
    <input type="number" name="type_id" value="<?= $activity['type_id'] ?>" class="border p-2 w-full" required>
    <input type="number" name="places_disponibles" value="<?= $activity['places_disponibles'] ?>" class="border p-2 w-full" required>
    <input type="text" name="description" value="<?= $activity['description'] ?>" class="border p-2 w-full" required>
    <input type="datetime-local" name="datetime_debut" value="<?= date('Y-m-d\TH:i', strtotime($activity['datetime_debut'])) ?>" class="border p-2 w-full" required>
    <input type="number" name="duree" value="<?= $activity['duree'] ?>" class="border p-2 w-full" required>
    <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Modifier</button>
</form>
