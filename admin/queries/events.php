<?php

require_once dirname(__DIR__, 2) . "/conf/conf.inc.php";


function getEventBySearch($search = "Disco Murder" )
{
    global $dbInstance;

    $query = "SELECT * FROM events WHERE title LIKE :search OR organizer LIKE :search";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC)[0] ?? null;
}

function updateEventInfos( $data)
{
    global $dbInstance;

    $query = "UPDATE events SET title = :title, organizer = :organizer, places_dispo = :places_dispo, location = :location WHERE id = :event_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':title', $data['title']);
    $stmt->bindParam(':organizer', $data['organizer']);
    $stmt->bindParam(':places_dispo', $data['places_dispo']);
    $stmt->bindParam(':location', $data['location']);
    $stmt->bindParam(':event_id', $data['event_id'], PDO::PARAM_INT);

    return $stmt->execute();
}