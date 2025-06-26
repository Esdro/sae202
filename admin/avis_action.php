<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}elseif (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}


require_once "queries/avis.php";


$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? '';

if (empty($action) || empty($id)) {
    $_SESSION['errorMessage'] = "Action ou ID manquant.";
    header("Location: avis_manage.php");
    exit();
}



function approveComment($id)
{
    global $dbInstance;

    $query = "UPDATE avis SET statut = 'publie' WHERE id = :id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['successMessage'] = "Commentaire approuvé avec succès.";
    } else {
        $_SESSION['errorMessage'] = "Erreur lors de l'approbation du commentaire.";
    }


    header("Location: avis_manage.php");
    exit();
}


function disapproveComment($id)
{
    global $dbInstance;

    $query = "UPDATE avis SET statut = 'brouillon' WHERE id = :id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['successMessage'] = "Commentaire rejeté avec succès.";
    } else {
        $_SESSION['errorMessage'] = "Erreur lors du rejet du commentaire.";
    }

    header("Location: avis_manage.php");
    exit();
}

function rejectComment($id)
{
    global $dbInstance;

    $query = "UPDATE avis SET statut = 'rejete' WHERE id = :id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['successMessage'] = "Commentaire rejeté avec succès.";
    } else {
        $_SESSION['errorMessage'] = "Erreur lors du rejet du commentaire.";
    }

    header("Location: avis_manage.php");
    exit();
}

function restoreComment($id)
{
    global $dbInstance;

    $query = "UPDATE avis SET statut = 'brouillon' WHERE id = :id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->execute()) {
        $_SESSION['flash']['message'] = "Commentaire restauré avec succès.";
    } else {
        $_SESSION['flash']['message'] = "Erreur lors de la restauration du commentaire.";
    }
    header("Location: avis_manage.php");
    exit();
}

switch ($action) {
    case 'restore':
        restoreComment($id);
        break;
    case 'approve':
        approveComment($id);
        break;
    case 'disapprove':
        disapproveComment($id);
        break;
    case 'reject':
        rejectComment($id);
        break;
    default:
        header("Location: avis_manage.php");
        exit();
}
