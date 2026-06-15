<section class="form-panel">
    <h1>Passagers d un trajet actif</h1>
    <?php if (!$trajets): ?>
        <p>Aucun trajet actif.</p>
    <?php else: ?>
        <form method="get" action="router.php">
            <input type="hidden" name="action" value="conducteurTrajetPassengers">
            <label>Trajet
                <select name="trajet_id" required>
                    <?php foreach ($trajets as $trajet): ?>
                        <option value="<?= e($trajet['id']) ?>">
                            <?= e($trajet['ville_depart_nom'] . ' -> ' . $trajet['ville_arrivee_nom'] . ' | ' . $trajet['date_depart'] . ' ' . substr($trajet['heure_depart'], 0, 5)) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <button type="submit">Afficher</button>
        </form>
    <?php endif; ?>
</section>
