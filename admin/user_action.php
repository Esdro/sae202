<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}elseif (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once "queries/users.php";

$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? '';

if (empty($action) || empty($id)) {
    $_SESSION['errorMessage'] = "Action ou ID manquant.";
    header("Location: users_manage.php");
    exit();
}

switch ($action) {
    case 'delete':
        if (deleteUser($id)) {
            $_SESSION['successMessage'] = "Utilisateur supprimé avec succès.";
        } else {
            $_SESSION['errorMessage'] = "Erreur lors de la suppression de l'utilisateur.";
        }
        break;

    default:
        $_SESSION['errorMessage'] = "Action inconnue.";
        break;
}

header("Location: users_manage.php");
exit();