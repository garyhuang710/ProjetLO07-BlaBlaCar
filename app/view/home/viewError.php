<section class="panel warning">
    <h1>Erreur</h1>
    <p><?= e($message) ?></p>
    <?php if (!empty($details)): ?>
        <pre><?= e($details) ?></pre>
    <?php endif; ?>
</section>
