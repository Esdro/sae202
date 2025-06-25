<?php

require_once dirname(__DIR__, 2) . "/conf/conf.inc.php";

require_once "users.php";

function getReservations() {
    global $dbInstance;

    $query = "SELECT * FROM reservations ORDER BY date_reservation DESC";
    $stmt = $dbInstance->prepare($query);
    $stmt->execute();

    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($reservations as &$reservation) {
        $reservation['date'] = date('d/m/Y H:i', strtotime($reservation['date_reservation']));
        // Assuming 'user_id' is a foreign key to a users table
        if (isset($reservation['user_id'])) {
            $user = getUserById($reservation['user_id']);
            $reservation['author'] = $user ? $user['username'] : 'Inconnu';
            $reservation['email'] = $user ? $user['email'] : 'Inconnu';
            $reservation['role'] = $user ? $user['role'] : 'Inconnu';
        }

        if ($reservation['is_confirmed'] == 1) {
            $reservation['statutClass']  = 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100';
            $reservation['statut'] = 'Confirmée';
        } elseif ($reservation['is_confirmed'] == 0) {
            $reservation['statutClass'] = 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100';
            $reservation['statut'] = 'En attente de confirmation';
        } 
    }

    return $reservations;
}

function countReservations() {
    global $dbInstance;

    $query = "SELECT COUNT(*) AS total FROM reservations";
    $stmt = $dbInstance->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total'] ?? 0;
}
