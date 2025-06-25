<?php

require_once $GLOBALS['model_dir'] . 'reservation_model.php';
require_once $GLOBALS['model_dir'] . 'event_model.php';
require_once $GLOBALS['helpers_dir'] . 'form_sanitizer.php';


function index(): void
{
    $title = "Mes réservations";
    $desc = "Gérez vos réservations.";

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        $_SESSION['errorMessage'] = 'Vous devez être connecté pour accéder à cette page.';
        header('Location: /connexion');
        exit;
    }

    $userId = $_SESSION['user']['id'];
    $reservations = getUserReservations($userId);

    require_once $GLOBALS['partials_dir'] . 'header.php';
    require_once $GLOBALS['view_dir'] . 'reservations_view.php';
    require_once $GLOBALS['partials_dir'] . 'footer.php';
}

function create(): void{
    $title = "Nouvelle réservation";
    $desc = "Créez une nouvelle réservation.";

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        $_SESSION['errorMessage'] = 'Vous devez être connecté pour créer une réservation.';
        header('Location: /connexion');
        exit;
    }

    $userId = $_SESSION['user']['id'];

    $event = getEventBySearch();

  //  var_dump($event);

    // Vérifier si les données du formulaire sont soumises
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'user_id' => $userId,
            'event_id' => (int) sanitizeInput($_POST['event_id'] ?? ''),
            'date_reservation' => sanitizeInput($_POST['date_reservation'] ?? ''),
            'nb_places' => (int) sanitizeInput($_POST['nb_places'] ?? 1),
            'is_group' => isset($_POST['is_group']) ? (int)$_POST['is_group'] : 0,
        ];

        $response = createReservation($userId, $data);

        if ($response['success']) {
            $_SESSION['successMessage'] = $response['message'];
            header('Location: /reservations');
            exit;
        } else {
            $_SESSION['errorMessage'] = $response['message'];
        }
    }

    require_once $GLOBALS['partials_dir'] . 'header.php';
    require_once $GLOBALS['view_dir'] . 'reservation_new_view.php';
    require_once $GLOBALS['partials_dir'] . 'footer.php';
}

function cancel() : void {
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        $_SESSION['errorMessage'] = 'Vous devez être connecté pour annuler une réservation.';
        header('Location: /connexion');
        exit;
    }

    $userId = $_SESSION['user']['id'];
    $reservationId = (int) sanitizeInput($_GET['id'] ?? 0);

    // Annuler la réservation
    $result = cancelReservation($reservationId);

    if ($result) {
        $_SESSION['successMessage'] = 'Réservation annulée avec succès.';
    } else {
        $_SESSION['errorMessage'] = 'Erreur lors de l\'annulation de la réservation.';
    }

    header('Location: /reservations');
    exit;
}


function view(): void
{
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        $_SESSION['errorMessage'] = 'Vous devez être connecté pour voir les détails de la réservation.';
        header('Location: /connexion');
        exit;
    }

    // Vérifier si l'ID de la réservation est fourni
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        $_SESSION['errorMessage'] = 'ID de réservation invalide.';
        header('Location: /reservations');
        exit;
    }

    $reservationId = (int)$_GET['id'];
    $reservation = getReservationDetails($reservationId);

    if (!$reservation) {
        $_SESSION['errorMessage'] = 'Réservation non trouvée.';
        header('Location: /reservations');
        exit;
    }

    require_once $GLOBALS['partials_dir'] . 'header.php';
    require_once $GLOBALS['view_dir'] . 'reservation_view.php';
    require_once $GLOBALS['partials_dir'] . 'footer.php';
}


function edit(): void
{
    $title = "Modifier la réservation";
    $desc = "Modifiez les détails de votre réservation.";
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        $_SESSION['errorMessage'] = 'Vous devez être connecté pour modifier une réservation.';
        header('Location: /connexion');
        exit;
    }

    // si formulaire soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $userRole = $_SESSION['user']['role'] ?? '';
        $userId = $_SESSION['user']['id'];
        $reservationId = (int) sanitizeInput($_POST['reservation_id'] ?? 0);

        // var_dump( $reservationId, isUserReservation( $userId, $reservationId));
        // die();
        // Vérifier si l'utilisateur a le droit de modifier cette réservation
        if (!isUserReservation($userId, $reservationId) || $userRole !== 'admin') {
            $_SESSION['errorMessage'] = 'Vous n\'êtes pas autorisé à modifier cette réservation.';
            header('Location: /reservations');
            exit;
        }

        $data = [
            'event_id' => (int) sanitizeInput($_POST['event_id'] ?? ''),
            'date_reservation' => sanitizeInput($_POST['date_reservation'] ?? ''),
            'nb_place' => (int) sanitizeInput($_POST['nb_place'] ?? 1),
            'is_group' => isset($_POST['is_group']) ? (int)$_POST['is_group'] : 0,
            'user_id' => $userId,
            'is_confirmed' => isset($_POST['is_confirmed']) ? (int)$_POST['is_confirmed'] : 0,
        ];

        $response = updateReservation($reservationId, $data);

        if ($response['success']) {
            $_SESSION['successMessage'] = $response['message'];
            header('Location: /reservations');
            exit;
        } else {
            $_SESSION['errorMessage'] = $response['message'];
            header('Location: /reservations/edit?id=' . $reservationId);
            exit;
        }
    }




    // Vérifier si l'ID de la réservation est fourni
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        $_SESSION['errorMessage'] = 'ID de réservation invalide.';
        header('Location: /reservations');
        exit;
    }

    $reservationId = (int)$_GET['id'];
    $reservation = getReservationDetails($reservationId);
    $user = $_SESSION['user'];

    if (!$reservation) {
        $_SESSION['errorMessage'] = 'Réservation non trouvée.';
        header('Location: /reservations');
        exit;
    }

    require_once $GLOBALS['partials_dir'] . 'header.php';
    require_once $GLOBALS['view_dir'] . 'reservation_edit_view.php';
    require_once $GLOBALS['partials_dir'] . 'footer.php';
}
