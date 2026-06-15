<section>
    <div class="section-title">
        <h1>Innovation data</h1>
    </div>
    <div class="metrics">
        <div><strong><?= e($stats['totaux']['utilisateurs']) ?></strong><span>utilisateurs</span></div>
        <div><strong><?= e($stats['totaux']['trajets_actifs']) ?></strong><span>trajets actifs</span></div>
        <div><strong><?= e($stats['totaux']['reservations']) ?></strong><span>reservations</span></div>
        <div><strong><?= number_format((float) $stats['totaux']['volume_reservations'], 2, ',', ' ') ?></strong><span>euros reserves</span></div>
    </div>

    <div class="two-columns">
        <article class="panel">
            <h2>Axes les plus reserves</h2>
            <table>
                <thead><tr><th>Axe</th><th>Reservations</th><th>Volume</th></tr></thead>
                <tbody>
                <?php foreach ($stats['routes'] as $route): ?>
                    <tr>
                        <td><?= e($route['route_label']) ?></td>
                        <td><?= e($route['reservations']) ?></td>
                        <td><?= number_format((float) $route['volume'], 2, ',', ' ') ?> euro</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </article>
        <article class="panel">
            <h2>Activite des conducteurs</h2>
            <table>
                <thead><tr><th>Conducteur</th><th>Trajets</th><th>Reservations</th><th>Volume</th></tr></thead>
                <tbody>
                <?php foreach ($stats['conducteurs'] as $conducteur): ?>
                    <tr>
                        <td><?= e($conducteur['conducteur']) ?></td>
                        <td><?= e($conducteur['trajets']) ?></td>
                        <td><?= e($conducteur['reservations']) ?></td>
                        <td><?= number_format((float) $conducteur['volume'], 2, ',', ' ') ?> euro</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </article>
    </div>
</section>
