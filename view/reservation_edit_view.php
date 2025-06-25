<div class="reservation_edit_container">
    <h1>Modifier la Réservation</h1>
    <form method="post" action="/reservations/edit?id=<?= $reservation['id'] ?>" class="form-container">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
        <input type="hidden" id="event_id" name="event_id" value="<?= htmlspecialchars($reservation['event_id']) ?>" >
        <input type="hidden" id="reservation_id" name="reservation_id" value="<?= htmlspecialchars($reservation['id']) ?>" >
        <div class="form_group">
            <label for="date_reservation">Date de la Réservation:</label>
            <input type="date" id="date_reservation" name="date_reservation" value="<?= htmlspecialchars($reservation['date_reservation']) ?>" required min="<?= date('Y-m-d') ?>">
        </div>
        <div class="form_group">
            <label for="nb_places">Nombre de Places:</label>
            <input type="number" id="nb_place" name="nb_place" value="<?= htmlspecialchars($reservation['nb_place']) ?>" required min="1">
        </div>
        <div class="form_group">
            <label for="is_group">Réservation en Groupe:</label>
            <input type="checkbox" id="is_group" name="is_group" value="1" <?= $reservation['is_group'] ? 'checked' : '' ?>>
        </div>
        <button type="submit" class="action-button">Modifier la Réservation</button>
    </form>
    <a href="/reservations" class="go_to_link">Retour aux Réservations</a>
</div>