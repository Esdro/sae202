<div class="reservations_container">
    <h1>Réserver une place pour l'événement: <?= htmlspecialchars($event['title']) ?></h1>
    <p><strong>Lieu:</strong> <?= htmlspecialchars($event['location']) ?></p>
    <p><strong>Organisateur:</strong> <?= htmlspecialchars($event['organizer']) ?></p>
    <p><strong>Places disponibles:</strong> <?= htmlspecialchars($event['places_dispo']) ?></p>

   <div class="form-container">
     <h2>Réserver une nouvelle place</h2>
    <form method="post" action="/reservations/create">

        <input type="number" hidden id="event_id" name="event_id" value="<?= htmlspecialchars($event['id']) ?>" required readonly>

        <div class="form-group">
            <label for="date_reservation">Date de réservation:</label>
            <input type="date" id="date_reservation" name="date_reservation" required min="<?= date('Y-m-d') ?>" >
        </div>

        <div class="form-group">
            <label for="is_group">Réservation en groupe:</label>
            <select id="is_group" name="is_group">
                <option value="0">Non</option>
                <option value="1">Oui</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nb_places">Nombre de places:</label>
            <input type="number" id="nb_places" name="nb_places" required min="1" value="1" max="<?= htmlspecialchars($event['places_dispo']) ?>">
        </div>

        <div class="form-group">
            <button type="submit">Réserver</button>
        </div>
    </form>
   </div>
</div>