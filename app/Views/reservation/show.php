<h1 class="text-2xl font-bold mb-4">Détail réservation</h1>

<p>Activité : <?= $reservation['activite'] ?></p>
<p>Date réservation : <?= $reservation['date_reservation'] ?></p>
<p>État : <?= $reservation['etat'] ? 'Confirmée' : 'Annulée' ?></p>

<?php if ($reservation['etat']): ?>
    <a href="/reservation/cancel/<?= $reservation['id'] ?>" class="text-red-600">Annuler la réservation</a>
<?php endif; ?>
