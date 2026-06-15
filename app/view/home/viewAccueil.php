<section class="hero">
    <div>
        <p class="eyebrow">Application MVC</p>
        <h1>BlaBlaCar LO07</h1>
        <?php if ($user): ?>
            <p>Connecte en tant que <?= e($user['prenom'] . ' ' . $user['nom']) ?>, role <?= e($user['role']) ?>.</p>
        <?php else: ?>
            <p>Connectez-vous pour afficher le menu correspondant a votre role.</p>
        <?php endif; ?>
    </div>
    <div class="login-hints">
        <strong>Comptes de test</strong>
        <span>boss / secret</span>
        <span>trisprior / secret</span>
        <span>calebprior / secret</span>
    </div>
</section>

<?php if ($user && $user['role'] === 'administrateur'): ?>
    <section class="quick-grid">
        <a href="router.php?action=adminUtilisateurs">Liste des utilisateurs</a>
        <a href="router.php?action=adminVehicules">Liste des vehicules</a>
        <a href="router.php?action=adminVilles">Liste des villes</a>
    </section>
<?php elseif ($user && $user['role'] === 'conducteur'): ?>
    <section class="quick-grid">
        <a href="router.php?action=conducteurVehicules">Mes vehicules</a>
        <a href="router.php?action=conducteurTrajets">Mes trajets</a>
        <a href="router.php?action=conducteurTrajetCreate">Ajouter un trajet</a>
    </section>
<?php elseif ($user && $user['role'] === 'passager'): ?>
    <section class="quick-grid">
        <a href="router.php?action=passagerReservations">Mes reservations</a>
        <a href="router.php?action=passagerReservationCreate">Reserver un trajet</a>
    </section>
<?php endif; ?>
