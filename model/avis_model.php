<?php

require_once $GLOBALS['conf_dir'] . "conf.inc.php";
require_once $GLOBALS['model_dir'] . "user_model.php";


function getUserAvis(int $userId): ?array
{
    global $dbInstance;

    // Vérifier si l'utilisateur existe
    if (!getUserById($userId)) {
        return null; // L'utilisateur n'existe pas
    }

    // Récupérer les avis de l'utilisateur
    $query = "SELECT * FROM avis WHERE user_id = :user_id ORDER BY date DESC";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Ajouter les noms d'utilisateur pour chaque avis
        foreach ($avis as &$avi) {
            $user = getUserById($avi['user_id']);
            $avi['username'] = $user ? $user['username'] : 'Inconnu';
            $avi['email'] = $user ? $user['email'] : 'Inconnu';
            $avi['role'] = $user ? $user['role'] : 'Inconnu';
        }

        return $avis;
    } 
    // Aucun avis trouvé pour cet utilisateur
    return null;

}

function createAvis(mixed $data): array
{
    global $dbInstance;

    // Vérifier si l'utilisateur existe
    if (!getUserById($data['user_id'])) {
        return ['success' => false, 'message' => 'Utilisateur non trouvé.'];
    }

    // Insérer l'avis dans la base de données
    $query = "INSERT INTO avis (user_id, content, rate, date, statut) VALUES (:user_id, :content, :rate, NOW(), 'brouillon')";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':user_id', $data['user_id']);
    $stmt->bindParam(':rate', $data['rate']);
    $stmt->bindParam(':content', $data['content']);

    if ($stmt->execute()) {
        return ['success' => true, 'message' => 'Avis créé avec succès.'];
    } else {
        return ['success' => false, 'message' => 'Erreur lors de la création de cet avis.'];
    }
}


function getAvisById(int $aviId): ?array
{
    global $dbInstance;

    // Récupérer le commentaire par son ID
    $query = "SELECT * FROM avis WHERE id = :avi_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':avi_id', $aviId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return null; // Aucun commentaire trouvé avec cet ID
}

function deleteAvis(int $aviId): array
{
    global $dbInstance;

    // Vérifier si le commentaire existe
    $avi = getAvisById($aviId);
    if (!$avi) {
        return ['success' => false, 'message' => 'Avi non trouvé.'];
    }
  

    // Supprimer le commentaire
    $query = "DELETE FROM avis WHERE id = :avi_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':avi_id', $aviId);

    if ($stmt->execute()) {
        return ['success' => true, 'message' => 'Avi supprimé avec succès.'];
    } else {
        return ['success' => false, 'message' => 'Erreur lors de la suppression du commentaire.'];
    }
}


function updateAvis(mixed $data): array
{
    global $dbInstance;

    // Vérifier si le commentaire existe
    $aviId = (int)$data['avi_id'];

    $avis = getAvisById($aviId);

    if (!$avis) {
        return ['success' => false, 'message' => 'Avis non trouvé.'];
    }

    // Mettre à jour l'avis
    $query = "UPDATE avis SET content = :content, rate = :rate WHERE id = :avi_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':content', $data['content']);
    $stmt->bindParam(':rate', $data['rate']);
    $stmt->bindParam(':avi_id',$aviId);

    if ($stmt->execute()) {
        return ['success' => true, 'message' => 'Avis mis à jour avec succès.'];
    } else {
        return ['success' => false, 'message' => 'Erreur lors de la mise à jour de l\'avis.'];
    }
}

function getAllPublishedAvis(?int $limit = 5): ?array
{
    global $dbInstance;

    // Récupérer tous les avis publiés
    $query = "SELECT * FROM avis WHERE statut = 'publie' ORDER BY date DESC";
    if ($limit) {
        $query .= " LIMIT :limit";
    }
    $stmt = $dbInstance->prepare($query);
    if ($limit) {
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    }
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Ajouter les noms d'utilisateur pour chaque avis
        foreach ($avis as &$avi) {
            $user = getUserById($avi['user_id']);
            $avi['username'] = $user ? $user['username'] : 'Inconnu';
            $avi['email'] = $user ? $user['email'] : 'Inconnu';
            $avi['role'] = $user ? $user['role'] : 'Inconnu';
        }

        return $avis;
    }

    return null; // Aucun avis publié trouvé
}