<section>
    <div class="section-title">
        <h1>Mes trajets</h1>
        <a class="button secondary" href="router.php?action=conducteurTrajetCreate">Ajouter trajet</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>Depart</th>
                <th>Arrivee</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Vehicule</th>
                <th>Prix</th>
                <th>Statut</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($trajets as $trajet): ?>
                <tr>
                    <td><?= e($trajet['ville_depart_nom']) ?></td>
                    <td><?= e($trajet['ville_arrivee_nom']) ?></td>
                    <td><?= e($trajet['date_depart']) ?></td>
                    <td><?= e(substr($trajet['heure_depart'], 0, 5)) ?></td>
                    <td><?= e($trajet['vehicule']) ?></td>
                    <td><?= number_format((float) $trajet['prix'], 2, ',', ' ') ?> euro</td>
                    <td><span class="badge <?= e($trajet['statut']) ?>"><?= e($trajet['statut']) ?></span></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
