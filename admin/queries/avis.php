<?php

require_once dirname(__DIR__, 2) . "/conf/conf.inc.php";

require_once "users.php";


function getAllAvis(): array
{
    global $dbInstance;

    $query = "SELECT * FROM avis ORDER BY date DESC";
    $stmt = $dbInstance->prepare($query);
    $stmt->execute();

    $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($avis as &$avi) {
        $avi['date'] = date('d/m/Y H:i', strtotime($avi['date']));

        // Assuming 'user_id' is a foreign key to a users table
        if (isset($avi['user_id'])) {
            $user = getUserById($avi['user_id']);
            $avi['author'] = $user ? $user['username'] : 'Inconnu';
            $avi['email'] = $user ? $user['email'] : 'Inconnu';
            $avi['role'] = $user ? $user['role'] : 'Inconnu';
        }

        if ($avi['statut'] == 'publie') {
            $avi['statutClass']  = 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100';
            $avi['statut'] = 'Approuvé';
        } elseif ($avi['statut'] == 'brouillon') {
            $avi['statutClass'] = 'text-yellow-700 bg-yellow-100 dark:bg-yellow-700 dark:text-yellow-100';
            $avi['statut'] = 'En attente';
        } elseif ($avi['statut'] == 'rejete') {
            $avi['statutClass'] = 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100';
            $avi['statut'] = 'Rejeté';
        }

    }

    return $avis;
}

function countComments()
{
    global $dbInstance;

    $query = "SELECT COUNT(*) AS total FROM avis";
    $stmt = $dbInstance->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total'] ?? 0;
}
