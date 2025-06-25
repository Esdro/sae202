<?php

require_once $GLOBALS['conf_dir'] . "conf.inc.php";
require_once $GLOBALS['model_dir'] . "user_model.php";



function getUserSentMessages(int $userId): array
{
    global $dbInstance;

    // Récupérer les messages de l'utilisateur
    $query = "SELECT * FROM messages WHERE user_id = :user_id ORDER BY date_envoi DESC";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();

    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($messages as &$message) {

        $message['author'] = getMessageExpediteurInfos($message['user_id']);

        if ($message['author']) {
            $message['author'] = $message['author']['username'];
        } else {
            $message['author'] = 'Inconnu';
        }

        // Récupérer le nom du destinataire
        $destinataireInfos = getMessageDestinataireInfos($message['id']);
        if ($destinataireInfos) {

            $message['destinataire'] = $destinataireInfos['username'];
        } else {
            $message['destinataire'] = 'Inconnu';
        }
    }
    return $messages;


}

function getUserReceivedMessages(int $userId): array
{
    global $dbInstance;

    // Récupérer les messages reçus par l'utilisateur
    $query = "SELECT * FROM messages WHERE destinataire = :user_id ORDER BY date_envoi DESC";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();

    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($messages as &$message) {
        // Récupérer le nom de l'expéditeur
        $expediteurInfos = getMessageExpediteurInfos($message['user_id']);
        if ($expediteurInfos) {
            $message['username'] = $expediteurInfos['username'];
        } else {
            $message['username'] = 'Inconnu';
        }
    }

    return $messages;
}

function getMessageExpediteurInfos(int $userId): ?array
{
    global $dbInstance;

    // Récupérer les informations de l'expéditeur du message
    $query = "SELECT id, username FROM users WHERE id = :user_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return null; // Aucun expéditeur trouvé pour cet ID
}

function getMessageDestinataireInfos(int $messageId): ?array
{
    global $dbInstance;

    // Récupérer les informations du destinataire du message
    $query = "SELECT u.id, u.username, u.email FROM messages m
              JOIN users u ON m.destinataire = u.id
              WHERE m.id = :message_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':message_id', $messageId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return $stmt->fetch();
    }

    return null; // Aucun destinataire trouvé pour ce message
}


function deleteMessage(int $messageId): bool
{
    global $dbInstance;

    // Supprimer le message de la base de données
    $query = "DELETE FROM messages WHERE id = :message_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':message_id', $messageId);

    return $stmt->execute();
}

function createMessage(int $userId, int $destinataire,  string $content, bool $isAdmin = false): array
{
    global $dbInstance;



    // Vérifier si le destinataire existe
   
    if($isAdmin) {
        // Si l'utilisateur est admin, on peut envoyer à n'importe qui
        $query = "SELECT id FROM users WHERE id = :destinataire";
    } else {
        // Sinon, on vérifie que le destinataire est un utilisateur normal
        $query = "SELECT id FROM users WHERE id = :destinataire AND role = 'admin'";
    }

    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':destinataire', $destinataire);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        return [
            'success' => false,
            'message' => 'Destinataire invalide.'
        ];
    }

    $date_envoi = date('Y-m-d H:i:s');
    // Insérer un nouveau message dans la base de données
    $query = "INSERT INTO messages (user_id, destinataire, contenu, date_envoi, statut) 
              VALUES (:user_id, :destinataire, :contenu, :date_envoi, 'non_lu')";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':destinataire', $destinataire);
    $stmt->bindParam(':contenu', $content);
    $stmt->bindParam(':date_envoi', $date_envoi);
    $stmt->execute();


    if ($stmt->rowCount() > 0) {
        return [
            'success' => true,
            'message' => 'Message envoyé avec succès.'
        ];
    } else {
        return [
            'success' => false,
            'message' => 'Erreur lors de l\'envoi du message.'
        ];
    }
}

function getMessageById(int $messageId): ?array
{
    global $dbInstance;

    // Récupérer le message par son ID
    $query = "SELECT * FROM messages WHERE id = :message_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':message_id', $messageId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $message = $stmt->fetch(PDO::FETCH_ASSOC);

        // Récupérer les informations de l'expéditeur
        $expediteurInfos = getMessageExpediteurInfos($message['user_id']);
        if ($expediteurInfos) {
            $message['author'] = $expediteurInfos['username'];
        } else {
            $message['author'] = 'Inconnu';
        }

        // passer les infos du destinataire
        $destinataireInfos = getMessageDestinataireInfos($messageId);

        if ($destinataireInfos) {
            $message['destinataire'] = $destinataireInfos['username'];
        } else {
            $message['destinataire'] = 'Inconnu';
        }

        return $message;
    }

    return null; // Aucun message trouvé avec cet ID
}

function markMessageAsRead(int $messageId): bool
{
    global $dbInstance;

    // Mettre à jour le statut du message en "lu"
    $query = "UPDATE messages SET statut = 'lu' WHERE id = :message_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':message_id', $messageId);

    return $stmt->execute();
}