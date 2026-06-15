<section>
    <div class="section-title">
        <h1>Passagers</h1>
        <a class="button secondary" href="router.php?action=conducteurTrajetPassengersForm">Changer de trajet</a>
    </div>
    <p class="lead"><?= e($trajet['ville_depart_nom']) ?> -> <?= e($trajet['ville_arrivee_nom']) ?>, <?= e($trajet['date_depart']) ?> a <?= e(substr($trajet['heure_depart'], 0, 5)) ?></p>
    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>Passager</th>
                <th>Login</th>
                <th>Places reservees</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($passagers as $passager): ?>
                <tr>
                    <td><?= e($passager['prenom'] . ' ' . $passager['nom']) ?></td>
                    <td><?= e($passager['login']) ?></td>
                    <td><?= e($passager['nb_places']) ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$passagers): ?>
                <tr><td colspan="3">Aucune reservation pour ce trajet.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
