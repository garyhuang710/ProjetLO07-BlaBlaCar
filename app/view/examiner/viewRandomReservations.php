<section class="panel success">
    <h1>Reservations aleatoires</h1>
    <p><?= e($result['message']) ?></p>
    <?php if (!empty($result['reservations'])): ?>
        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>Reservation</th>
                    <th>Trajet</th>
                    <th>Passager</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($result['reservations'] as $reservation): ?>
                    <tr>
                        <td><?= e($reservation['id']) ?></td>
                        <td><?= e($reservation['trajet_id']) ?></td>
                        <td><?= e($reservation['passager_id']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>
