<h1 class="text-2xl font-bold mb-4">Mes réservations</h1>

<?php foreach ($reservations as $r): ?>
    <div class="p-4 border-b flex justify-between items-center">
        <span><?= $r['activite'] ?> - <?= $r['date_reservation'] ?> - <?= $r['etat'] ? 'Confirmée' : 'Annulée' ?></span>
        <?php if ($r['etat']): ?>
            <a href="/reservation/cancel/<?= $r['id'] ?>" class="text-red-600">Annuler</a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
