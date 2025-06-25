<?php

require_once $GLOBALS['model_dir'] . 'user_model.php';
require_once $GLOBALS['helpers_dir'] . 'form_sanitizer.php';

function index(): void
{
    $title = "Inscription";
    $desc = "Inscrivez-vous pour accéder à l'espace d'administration.";

    // Vérifier si l'utilisateur est déjà connecté
    if (isset($_SESSION['user'])) {
        $_SESSION['errorMessage'] = 'Un utilisateur est déjà connecté. Veuillez vous déconnecter avant de vous inscrire.';
        header('Location: /');
        exit;
    }

    require_once $GLOBALS['partials_dir'] . 'header.php';
    require_once $GLOBALS['view_dir'] . 'inscription_view.php';
    require_once $GLOBALS['partials_dir'] . 'footer.php';
}


function formHandle(): void
{

    // Gérer la soumission du formulaire de connexion
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = sanitizeInput($_POST['username']) ?? '';
        $password = sanitizeInput($_POST['password']) ?? '';
        $email = sanitizeInput($_POST['email']) ?? '';

        // créer l'utilisateur
        $response = create_user(
            $username,
            $password,
            $email,
            null
        );

        if ($response['success']) {
            $_SESSION['successMessage'] = $response['message'];
            header('Location: /connexion');
            exit;
        } else {
            $_SESSION['errorMessage']  = $response['message'];

            header('Location: /inscription');
            exit;
        }
    } else {
        $_SESSION['errorMessage'] = 'Méthode de requête non autorisée.';
        header('Location: /inscription');
        exit;
    }
}

function logout(): void
{

    unset($_SESSION['user']);
    $_SESSION['successMessage'] = 'Déconnexion réussie.';
    header('Location: /', true, 302);
    exit;
}
