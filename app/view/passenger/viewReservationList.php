<section>
    <div class="section-title">
        <h1>Mes reservations</h1>
        <a class="button secondary" href="router.php?action=passagerReservationCreate">Reserver</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>Depart</th>
                <th>Arrivee</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Conducteur</th>
                <th>Vehicule</th>
                <th>Prix</th>
                <th>Statut</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?= e($reservation['ville_depart_nom']) ?></td>
                    <td><?= e($reservation['ville_arrivee_nom']) ?></td>
                    <td><?= e($reservation['date_depart']) ?></td>
                    <td><?= e(substr($reservation['heure_depart'], 0, 5)) ?></td>
                    <td><?= e($reservation['conducteur']) ?></td>
                    <td><?= e($reservation['vehicule']) ?></td>
                    <td><?= number_format((float) $reservation['prix'], 2, ',', ' ') ?> euro</td>
                    <td><span class="badge <?= e($reservation['statut']) ?>"><?= e($reservation['statut']) ?></span></td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$reservations): ?>
                <tr><td colspan="8">Aucune reservation.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
