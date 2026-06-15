<section>
    <div class="section-title">
        <h1>Reserver un trajet actif</h1>
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
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($trajets as $trajet): ?>
                <tr>
                    <td><?= e($trajet['ville_depart_nom']) ?></td>
                    <td><?= e($trajet['ville_arrivee_nom']) ?></td>
                    <td><?= e($trajet['date_depart']) ?></td>
                    <td><?= e(substr($trajet['heure_depart'], 0, 5)) ?></td>
                    <td><?= e($trajet['conducteur']) ?></td>
                    <td><?= e($trajet['vehicule']) ?></td>
                    <td><?= number_format((float) $trajet['prix'], 2, ',', ' ') ?> euro</td>
                    <td>
                        <form method="post" action="router.php" class="inline-form">
                            <input type="hidden" name="action" value="passagerReservationCreated">
                            <input type="hidden" name="trajet_id" value="<?= e($trajet['id']) ?>">
                            <button type="submit">Reserver</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$trajets): ?>
                <tr><td colspan="8">Aucun trajet actif disponible.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
