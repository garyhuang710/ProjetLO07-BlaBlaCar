<section class="form-panel">
    <h1>Ajouter un trajet</h1>
    <form method="post" action="router.php">
        <input type="hidden" name="action" value="conducteurTrajetCreated">
        <div class="form-grid">
            <label>Ville depart
                <select name="ville_depart" required>
                    <?php foreach ($villes as $ville): ?>
                        <option value="<?= e($ville['id']) ?>"><?= e($ville['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>Ville arrivee
                <select name="ville_arrivee" required>
                    <?php foreach ($villes as $ville): ?>
                        <option value="<?= e($ville['id']) ?>"><?= e($ville['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>Vehicule
                <select name="vehicule_id" required>
                    <?php foreach ($vehicules as $vehicule): ?>
                        <option value="<?= e($vehicule['id']) ?>">
                            <?= e($vehicule['marque'] . ' ' . $vehicule['modele'] . ' - ' . $vehicule['immatriculation']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>Prix <input type="number" name="prix" step="0.01" min="0" required></label>
            <label>Date depart <input type="date" name="date_depart" required></label>
            <label>Heure depart <input type="time" name="heure_depart" required></label>
        </div>
        <button type="submit">Creer le trajet</button>
    </form>
</section>
