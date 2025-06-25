<?php

require_once dirname(__DIR__, 1) . "/helpers/form_sanitizer.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "queries/messages.php";

$isReplying = isset($_POST['reply_id']) && !empty($_POST['reply_id']);

    if ($isReplying) {
         sendReplyMessage(sanitizeArray($_POST));
    } else {
        sendMessage(sanitizeArray($_POST));
    }

    if ($result['success']) {
        $_SESSION['flash']['message'] = $result['message'];
        header("Location: messages_manage.php");
        exit;
    } else {
        $_SESSION['flash']['message'] = $result['message'];
        header("Location: messages_form.php");
        exit;
    }



  
} else {
    $_SESSION['flash']['message'] = "Méthode de requête non autorisée.";
    header("Location: messages_manage.php");
    exit();
}


function sendMessage(array $data): array
{
    global $dbInstance;

    $query = "INSERT INTO messages (user_id, date_envoi, contenu, destinataire, reply_id) VALUES (:user_id, :date_envoi, :contenu, :destinataire, 0)";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':user_id', $data['user_id']);
    $stmt->bindParam(':date_envoi', $data['date_envoi']);
    $stmt->bindParam(':contenu', $data['contenu']);
    $stmt->bindParam(':destinataire', $data['destinataire']);

    if ($stmt->execute()) {
     $_SESSION['flash']['message'] = "Message envoyé avec succès.";
        header("Location: messages_manage.php");
        exit;
    } else {
        $_SESSION['flash']['message'] = "Erreur lors de l'envoi du message.";
        header("Location: messages_form.php");
        exit;
    }
}

function sendReplyMessage(array $data): array
{
    global $dbInstance;

    $query = "INSERT INTO messages (user_id, date_envoi, contenu, destinataire, reply_id) VALUES (:user_id, :date_envoi, :contenu, :destinataire, :reply_id)";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':user_id', $data['user_id']);
    $stmt->bindParam(':date_envoi', $data['date_envoi']);
    $stmt->bindParam(':contenu', $data['contenu']);
    $stmt->bindParam(':destinataire', $data['destinataire']);
    $stmt->bindParam(':reply_id', $data['reply_id']);

    if ($stmt->execute()) {
        $_SESSION['flash']['message'] = "Réponse envoyée avec succès.";
        header("Location: messages_manage.php");
        exit;
    } else {
        $_SESSION['flash']['message'] = "Erreur lors de l'envoi de la réponse.";
        header("Location: messages_form.php");
        exit;
    }
}