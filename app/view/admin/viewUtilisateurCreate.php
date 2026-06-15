<section class="form-panel">
    <h1>Ajouter un <?= e($role) ?></h1>
    <form method="post" action="router.php">
        <input type="hidden" name="action" value="<?= e($targetAction) ?>">
        <div class="form-grid">
            <label>Nom <input name="nom" required></label>
            <label>Prenom <input name="prenom" required></label>
            <label>Login <input name="login" required></label>
            <label>Mot de passe <input name="password" value="secret" required></label>
            <label>Solde <input type="number" name="solde" value="100.00" step="0.01" min="0" required></label>
        </div>
        <button type="submit">Ajouter</button>
    </form>
</section>
