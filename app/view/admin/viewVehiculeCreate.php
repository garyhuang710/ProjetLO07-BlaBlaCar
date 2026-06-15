<section class="form-panel">
    <h1>Ajouter un vehicule</h1>
    <form method="post" action="router.php">
        <input type="hidden" name="action" value="adminVehiculeCreated">
        <div class="form-grid">
            <label>Marque <input name="marque" required></label>
            <label>Modele <input name="modele" required></label>
            <label>Annee <input type="number" name="annee" min="1950" max="2035" required></label>
            <label>Immatriculation <input name="immatriculation" required></label>
            <label class="wide">Proprietaire
                <select name="proprietaire_id" required>
                    <?php foreach ($conducteurs as $conducteur): ?>
                        <option value="<?= e($conducteur['id']) ?>">
                            <?= e($conducteur['prenom'] . ' ' . $conducteur['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>
        <button type="submit">Ajouter</button>
    </form>
</section>
