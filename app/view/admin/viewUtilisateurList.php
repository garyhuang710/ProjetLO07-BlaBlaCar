<section>
    <div class="section-title">
        <h1>Utilisateurs</h1>
        <div class="actions">
            <a class="button secondary" href="router.php?action=adminConducteurCreate">Ajouter conducteur</a>
            <a class="button secondary" href="router.php?action=adminPassagerCreate">Ajouter passager</a>
        </div>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Role</th>
                <th>Login</th>
                <th>Solde</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <tr>
                    <td><?= e($utilisateur['id']) ?></td>
                    <td><?= e($utilisateur['nom']) ?></td>
                    <td><?= e($utilisateur['prenom']) ?></td>
                    <td><span class="badge"><?= e($utilisateur['role']) ?></span></td>
                    <td><?= e($utilisateur['login']) ?></td>
                    <td><?= number_format((float) $utilisateur['solde'], 2, ',', ' ') ?> euro</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
