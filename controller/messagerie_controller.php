<?php

require_once $GLOBALS['model_dir'] . 'message_model.php';
require_once $GLOBALS['helpers_dir'] . 'form_sanitizer.php';


function index(): void
{
    $title = "Messagerie";
    $desc = "Gérez vos messages.";

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        $_SESSION['errorMessage'] = 'Vous devez être connecté pour accéder à cette page.';
        header('Location: /connexion');
        exit;
    }

    $messages = getUserSentMessages($_SESSION['user']['id']);
    $receivedMessages = getUserReceivedMessages($_SESSION['user']['id']);

    $adminUsers = getAdminUsers();

    // var_dump( $_SESSION['user'],  $receivedMessages);
    // die();

    require_once $GLOBALS['partials_dir'] . 'header.php';
    require_once $GLOBALS['view_dir'] . 'messagerie_view.php';
    require_once $GLOBALS['partials_dir'] . 'footer.php';
}


function send()
{
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        $_SESSION['errorMessage'] = 'Vous devez être connecté pour envoyer un message.';
        header('Location: /connexion');
        exit;
    }

    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId = $_SESSION['user']['id'];
        $destinataire = sanitizeInput($_POST['destinataire']);
        $contenu = sanitizeInput($_POST['contenu']);

        // Valider les données
        if (empty($destinataire) || empty($contenu)) {
            $_SESSION['errorMessage'] = 'Veuillez remplir tous les champs.';
            header('Location: /messagerie');
            exit;
        }

        // Enregistrer le message dans la base de données
        $result = createMessage($userId, $destinataire, $contenu, $_SESSION['user']['role'] === 'admin');

        if ($result['success']) {
            $_SESSION['successMessage'] = $result['message'];
        } else {
            $_SESSION['errorMessage'] = $result['message'];
        }

        header('Location: /messagerie');
        exit;
    }

    // Si le formulaire n'a pas été soumis, afficher le formulaire d'envoi de message
    $title = "Envoyer un message";
    $desc = "Envoyez un message à un utilisateur.";
    $adminUsers = getAdminUsers();
    require_once $GLOBALS['partials_dir'] . 'header.php';
    require_once $GLOBALS['view_dir'] . 'send_message_view.php';
    require_once $GLOBALS['partials_dir'] . 'footer.php';
}


function view(): void
{
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        $_SESSION['errorMessage'] = 'Vous devez être connecté pour voir les messages.';
        header('Location: /connexion');
        exit;
    }

    // Vérifier si l'ID du message est fourni
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        $_SESSION['errorMessage'] = 'ID de message invalide.';
        header('Location: /messagerie');
        exit;
    }

    $messageId = (int)$_GET['id'];
    $message = getMessageById($messageId);

    $allMessages = getUserSentMessages($_SESSION['user']['id']);

    if (!$message) {
        $_SESSION['errorMessage'] = 'Message non trouvé.';
        header('Location: /messagerie');
        exit;
    }

    // Marquer le message comme lu
    markMessageAsRead($messageId);

    require_once $GLOBALS['partials_dir'] . 'header.php';
    require_once $GLOBALS['view_dir'] . 'message_view_view.php';
    require_once $GLOBALS['partials_dir'] . 'footer.php';
}

function delete(): void
{
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        $_SESSION['errorMessage'] = 'Vous devez être connecté pour supprimer un message.';
        header('Location: /connexion');
        exit;
    }

    // Vérifier si l'ID du message est fourni
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        $_SESSION['errorMessage'] = 'ID de message invalide.';
        header('Location: /messagerie');
        exit;
    }

    $messageId = (int)$_GET['id'];

    // Supprimer le message
    if (deleteMessage($messageId)) {
        $_SESSION['successMessage'] = 'Message supprimé avec succès.';
    } else {
        $_SESSION['errorMessage'] = 'Erreur lors de la suppression du message.';
    }

    header('Location: /messagerie');
    exit;
}
