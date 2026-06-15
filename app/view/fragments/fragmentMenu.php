<header class="topbar">
    <a class="brand" href="router.php?action=accueil">BlaBlaCar LO07</a>
    <div class="identity">
        <span><?= e(STUDENT_1) ?> et <?= e(STUDENT_2) ?></span>
        <?php if ($currentUser): ?>
            <span><?= e($currentUser['prenom'] . ' ' . $currentUser['nom']) ?></span>
            <span><?= number_format((float) $currentUser['solde'], 2, ',', ' ') ?> euro</span>
        <?php endif; ?>
    </div>
    <nav class="nav">
        <?php if ($currentUser && $currentUser['role'] === 'administrateur'): ?>
            <details class="nav-group">
                <summary>Administrateur</summary>
                <a href="router.php?action=adminUtilisateurs">Utilisateurs</a>
                <a href="router.php?action=adminConducteurCreate">Ajouter conducteur</a>
                <a href="router.php?action=adminPassagerCreate">Ajouter passager</a>
                <a href="router.php?action=adminVehicules">Vehicules</a>
                <a href="router.php?action=adminVehiculeCreate">Ajouter vehicule</a>
                <a href="router.php?action=adminVilles">Villes</a>
                <a href="router.php?action=adminVilleCreate">Ajouter ville</a>
            </details>
        <?php endif; ?>

        <?php if ($currentUser && $currentUser['role'] === 'conducteur'): ?>
            <details class="nav-group">
                <summary>Conducteur</summary>
                <a href="router.php?action=conducteurVehicules">Mes vehicules</a>
                <a href="router.php?action=conducteurTrajets">Mes trajets</a>
                <a href="router.php?action=conducteurTrajetCreate">Ajouter trajet</a>
                <a href="router.php?action=conducteurTrajetPassengersForm">Passagers</a>
                <a href="router.php?action=conducteurTrajetClose">Cloturer</a>
            </details>
        <?php endif; ?>

        <?php if ($currentUser && $currentUser['role'] === 'passager'): ?>
            <details class="nav-group">
                <summary>Passager</summary>
                <a href="router.php?action=passagerReservations">Mes reservations</a>
                <a href="router.php?action=passagerReservationCreate">Reserver</a>
            </details>
        <?php endif; ?>

        <details class="nav-group">
            <summary>Innovations</summary>
            <a href="router.php?action=innovationData">Innovation data</a>
            <a href="router.php?action=innovationMvc">Innovation MVC</a>
        </details>

        <details class="nav-group">
            <summary>Examinateur</summary>
            <a href="router.php?action=examinateurSuperglobales">Superglobales</a>
            <a href="router.php?action=examinateurRandomReservations">+10 reservations</a>
        </details>

        <?php if ($currentUser): ?>
            <a class="nav-link" href="router.php?action=logout">Se deconnecter</a>
        <?php else: ?>
            <a class="nav-link" href="router.php?action=login">Se connecter</a>
        <?php endif; ?>
    </nav>
</header>
