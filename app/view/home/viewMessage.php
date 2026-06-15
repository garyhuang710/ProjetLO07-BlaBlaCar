<section class="panel <?= e($variant ?? 'info') ?>">
    <h1><?= e($heading) ?></h1>
    <p><?= e($message) ?></p>
    <a class="button" href="router.php?action=<?= e($nextAction) ?>"><?= e($nextLabel) ?></a>
</section>
