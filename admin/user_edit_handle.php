<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}elseif (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once "queries/users.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $role = $_POST['role'] ?? null;

    if (!$id || !is_numeric($id)) {
        $_SESSION['errorMessage'] = "ID d'utilisateur invalide.";
        header("Location: /admin/users_manage.php");
        exit;
    }

    $user = getUserById($id);
    if (!$user) {
        $_SESSION['errorMessage'] = "Utilisateur introuvable.";
        header("Location: /admin/users_manage.php");
        exit;
    }

    // Validation des données
    if (!$username || !$email || !$role) {
        $_SESSION['errorMessage'] = "Tous les champs sont requis.";
        header("Location: /admin/user_edit.php?id=" . urlencode($id));
        exit;
    }

    // Mise à jour de l'utilisateur
    $result = updateUser($id, $username, $email, $role);
    if ($result) {
        $_SESSION['successMessage'] = "Utilisateur mis à jour avec succès.";
    } else {
        $_SESSION['errorMessage'] = "Erreur lors de la mise à jour de l'utilisateur.";
    }

    header("Location: /admin/users_manage.php");
    exit;
}