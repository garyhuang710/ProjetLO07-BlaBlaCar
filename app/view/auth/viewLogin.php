<section class="form-panel">
    <h1>Connexion</h1>
    <?php if ($error): ?>
        <p class="alert"><?= e($error) ?></p>
    <?php endif; ?>
    <form method="post" action="router.php">
        <input type="hidden" name="action" value="logged">
        <label>
            Login
            <input name="login" value="<?= e($login) ?>" required>
        </label>
        <label>
            Mot de passe
            <input type="password" name="password" required>
        </label>
        <button type="submit">Se connecter</button>
    </form>
</section>
