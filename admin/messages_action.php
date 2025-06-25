<?php

require_once "queries/messages.php";

$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? '';

if (empty($action) || empty($id)) {
    $_SESSION['flash']['message'] = "Action ou ID manquant.";
    header("Location: reservations_manage.php");
    exit();
}




function viewMessage(int $messageId): void
{
    global $dbInstance;

    // Récupérer le message
    $query = "SELECT * FROM messages WHERE id = :message_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':message_id', $messageId);
    $stmt->execute();
    
    $message = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($message) {
        $_SESSION['flash']['message'] = "Message récupéré avec succès.";
        // Afficher le message ou rediriger vers une page de visualisation
        header("Location: /admin/message_view.php?id=" . $messageId);
        exit();
    } else {
        $_SESSION['flash']['message'] = "Message non trouvé.";
        header("Location: messages_manage.php");
        exit();
    }
}

function replyToMessage(int $messageId): void
{
    global $dbInstance;

    // Récupérer le message pour la réponse
    $query = "SELECT * FROM messages WHERE id = :message_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':message_id', $messageId);
    $stmt->execute();
    
    $message = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($message) {
        $_SESSION['flash']['message'] = "Message récupéré pour la réponse.";
        // Afficher le formulaire de réponse ou rediriger vers une page de réponse
        header("Location: /admin/message_form_reply.php?id=" . $messageId);
        exit();
    } else {
        $_SESSION['flash']['message'] = "Message non trouvé.";
        header("Location: messages_manage.php");
        exit();
    }
}

switch ($action) {
    case 'view':
        viewMessage($id);
        break;
    case 'reply':
        replyToMessage($id);
        break;
    default:
        $_SESSION['flash']['message'] = "Action non reconnue.";
        header("Location: messages_manage.php");
        exit();
}