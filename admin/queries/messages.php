<?php

require_once dirname(__DIR__, 2) . "/conf/conf.inc.php";
require_once "users.php";


function getMessages()
{
    global $dbInstance;

    $query = "SELECT * FROM messages ORDER BY date_envoi DESC";
    $stmt = $dbInstance->prepare($query);
    $stmt->execute();

    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$messages) {
        return []; // No messages found
    }
    foreach ($messages as &$message) {
        $message['date'] = date('d/m/Y H:i', strtotime($message['date_envoi']));
        $message['contenu'] = htmlspecialchars($message['contenu'], ENT_QUOTES, 'UTF-8');
       
            $user = getUserById($message['user_id']);
            $message['author'] = $user['username'];
            $message['email'] = $user['email'];
            $message['role'] = $user['role'];
            $message['is_replied'] = isMessageReplied($message['id']);
    }

    return $messages;
}


function isMessageReplied(int $messageId): bool
{
    global $dbInstance;

    $query = "SELECT COUNT(*) FROM messages WHERE reply_id = :message_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':message_id', $messageId);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count > 0;
}



function countMessages()
{
    global $dbInstance;

    $query = "SELECT COUNT(*) AS total FROM messages";
    $stmt = $dbInstance->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total'] ?? 0;
}


function getOneMessage(int $messageId)
{
    global $dbInstance;

    $query = "SELECT * FROM messages WHERE id = :message_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':message_id', $messageId);
    $stmt->execute();

    $message = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($message) {
        $message['date'] = date('d/m/Y H:i', strtotime($message['date_envoi']));
        $message['contenu'] = htmlspecialchars($message['contenu'], ENT_QUOTES, 'UTF-8');
        
        $user = getUserById($message['user_id']);
        $message['author'] = $user['username'];
        $message['email'] = $user['email'];
        $message['destinataire'] = $message['destinataire'] ? getUserById($message['destinataire'])['username'] : 'Inconnu';
        $message['reply_id'] = $message['reply_id'] ? getOneMessage($message['reply_id']) : null;
        $message['is_replied'] = isMessageReplied($message['id']);

        $message['role'] = $user['role'];
        $message['author_id'] = $user['id'];

        return $message;
    }

    return null;
}