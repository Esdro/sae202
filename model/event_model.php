<?php

require_once $GLOBALS['conf_dir'] . 'conf.inc.php';




function getEventById(int $eventId): ?array
{
    global $dbInstance;

    // Récupérer les détails d'un événement par son ID
    $query = "SELECT * FROM events WHERE id = :event_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':event_id', $eventId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return null;
}

function updateEvent(int $eventId, array $data): bool
{
    global $dbInstance;

    // Mettre à jour les détails d'un événement
    $query = "UPDATE events SET title = :title, location = :location, organizer = :organizer, places_dispo = :places_dispo WHERE id = :event_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':title', $data['title']);
    $stmt->bindParam(':date', $data['date']);
    $stmt->bindParam(':location', $data['location']);
    $stmt->bindParam(':organizer', $data['organizer']);
    $stmt->bindParam(':places_dispo', $data['places_dispo']);
    $stmt->bindParam(':event_id', $eventId);

    return $stmt->execute();
}


function getEventBySearch(string $searchTerm = "Disco Murder"): array
{
    global $dbInstance;

    // Récupérer tous les événements
    $query = "SELECT * FROM events WHERE title LIKE :searchTerm LIMIT 1";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
}

