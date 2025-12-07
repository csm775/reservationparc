<h1 class="text-2xl font-bold mb-4"><?= $activity['nom'] ?></h1>
<p><?= $activity['description'] ?></p>
<p>Places restantes : <?= $placesLeft ?></p>

<?php if ($placesLeft > 0 && isset($_SESSION['user'])): ?>
    <form method="post" action="/reservation/create/<?= $activity['id'] ?>">
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded mt-4">Réserver</button>
    </form>
<?php elseif (!isset($_SESSION['user'])): ?>
    <p class="text-red-600">Connectez-vous pour réserver</p>
<?php else: ?>
    <p class="text-red-600">Activité complète</p>
<?php endif; ?>

<?php if (\App\Core\Auth::checkAdmin()): ?>
    <a href="/activity/update/<?= $activity['id'] ?>" class="text-yellow-600 mr-2">Modifier</a>
    <a href="/activity/delete/<?= $activity['id'] ?>" class="text-red-600">Supprimer</a>
<?php endif; ?>
