<section>
    <div class="section-title">
        <h1>Mes vehicules</h1>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>Marque</th>
                <th>Modele</th>
                <th>Annee</th>
                <th>Immatriculation</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($vehicules as $vehicule): ?>
                <tr>
                    <td><?= e($vehicule['marque']) ?></td>
                    <td><?= e($vehicule['modele']) ?></td>
                    <td><?= e($vehicule['annee']) ?></td>
                    <td><?= e($vehicule['immatriculation']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
