
<div class="reservation_view_container">
    <h1>Détails de la Réservation</h1>
    <div class="reservation_details">
        <p><strong>Date de la Réservation:</strong> <?= htmlspecialchars($reservation['date_reservation']) ?></p>
        <p><strong>En Groupe:</strong> <?= $reservation['is_group'] ? 'Oui' : 'Non' ?></p>
        <p><strong>Confirmée:</strong> <?= $reservation['is_confirmed'] ? 'Oui' : 'Non' ?></p>
        <p><strong>Nombre de Places:</strong> <?= htmlspecialchars($reservation['nb_place']) ?></p>
    </div>
    
    <div class="action-buttons">
        <a href="/reservations/edit?id=<?= $reservation['id'] ?>" class="action-button">Modifier</a>
        <a href="/reservations/cancel?id=<?= $reservation['id'] ?>" class="action-button">Annuler</a>
      
    </div>

    <a href="/reservations" class="go_to_link">Retour aux Réservations</a>
</div>