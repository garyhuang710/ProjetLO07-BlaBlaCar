<section>
    <div class="section-title">
        <h1>Cloturer un trajet actif</h1>
    </div>
    <?php if (!$trajets): ?>
        <p>Aucun trajet actif a cloturer.</p>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>Depart</th>
                    <th>Arrivee</th>
                    <th>Date</th>
                    <th>Heure</th>
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
                        <td><?= number_format((float) $trajet['prix'], 2, ',', ' ') ?> euro</td>
                        <td>
                            <form method="post" action="router.php" class="inline-form">
                                <input type="hidden" name="action" value="conducteurTrajetClosed">
                                <input type="hidden" name="trajet_id" value="<?= e($trajet['id']) ?>">
                                <button type="submit">Cloturer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>
