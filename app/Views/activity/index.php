<h1 class="text-2xl font-bold mb-4">Liste des activités</h1>

<?php foreach ($activities as $a): ?>
    <div class="p-4 border-b flex justify-between items-center">
        <span class="font-semibold"><?= $a['nom'] ?></span>
        <a href="/activity/show/<?= $a['id'] ?>" class="text-blue-600">Voir</a>
    </div>
<?php endforeach; ?>

