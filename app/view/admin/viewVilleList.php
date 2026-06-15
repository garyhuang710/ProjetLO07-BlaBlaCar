<section>
    <div class="section-title">
        <h1>Villes</h1>
        <a class="button secondary" href="router.php?action=adminVilleCreate">Ajouter ville</a>
    </div>
    <div class="city-list">
        <?php foreach ($villes as $ville): ?>
            <span><?= e($ville['nom']) ?></span>
        <?php endforeach; ?>
    </div>
</section>
