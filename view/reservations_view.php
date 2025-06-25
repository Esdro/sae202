
<div class="reservations_container">
    <?php if (!empty($reservations)): ?>
        <h2>Mes Réservations passées</h2>
        <ul class="reservations_list">
            <?php foreach ($reservations as $reservation): ?>
                <li class="reservation_item">
                    <div class="reservation_details">
                        <p><strong>Date:</strong> <?= htmlspecialchars($reservation['date_reservation']) ?></p>
                        <p><strong>En groupe:</strong> <?= $reservation['is_group'] ? 'Oui' : 'Non' ?></p>
                        <p><strong>Confirmée:</strong> <?= $reservation['is_confirmed'] ? 'Oui' : 'Non' ?></p>
                    </div>
                    <div class="reservation_actions">
                        <a href="/reservations/view?id=<?= $reservation['id'] ?>" class="view_link">Voir</a>
                        <a href="/reservations/edit?id=<?= $reservation['id'] ?>" class="edit_link">Modifier</a>
                        <a href="/reservations/cancel?id=<?= $reservation['id'] ?>" class="cancel_link">Annuler</a>

                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="/reservations/create" class="go_to_link">Réserver une nouvelle place</a>
    <?php else: ?>
        <p>Aucune réservation trouvée.</p>

        <a href="/reservations/create" class="go_to_link">Réserver une nouvelle place</a>

    <?php endif; ?>
</div>