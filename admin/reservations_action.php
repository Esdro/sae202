<?php

require_once "queries/reservations.php";

$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? '';

if (empty($action) || empty($id)) {
    $_SESSION['errorMessage'] = "Action ou ID manquant.";
    header("Location: reservations_manage.php");
    exit();
}



function cancelReservation(int $reservationId): void
{
    global $dbInstance;



    // Annuler la réservation
    $query = "UPDATE reservations SET is_confirmed = 0 WHERE id = :reservation_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':reservation_id', $reservationId);

    if ($stmt->execute()) {
        $_SESSION['successMessage'] = "Réservation annulée avec succès.";
        header("Location: reservations_manage.php");
        exit();
    } else {
        $_SESSION['errorMessage'] = "Erreur lors de l'annulation de la réservation.";
        header("Location: reservations_manage.php");
        exit();
    }
    exit();
}

function confirmReservation(int $reservationId): void
{
    global $dbInstance;


    // Confirmer la réservation
    $query = "UPDATE reservations SET is_confirmed = 1 WHERE id = :reservation_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':reservation_id', $reservationId);

    if ($stmt->execute()) {
        $_SESSION['successMessage'] = "Réservation confirmée avec succès.";
          header("Location: reservations_manage.php");
        exit();
    } else {
        $_SESSION['errorMessage'] = "Erreur lors de la confirmation de la réservation.";
          header("Location: reservations_manage.php");
        exit();
    }
    header("Location: reservations_manage.php");
    exit();
}


switch ($action) {
    case 'confirm':
        confirmReservation($id);
        break;
    case 'cancel':
        cancelReservation($id);
        break;
    default:
        $_SESSION['errorMessage'] = "Action invalide.";
        header("Location: reservations_manage.php");
        exit();
}
