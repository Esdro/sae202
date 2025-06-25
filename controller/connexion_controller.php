<?php

require_once $GLOBALS['model_dir'] . 'user_model.php';
require_once $GLOBALS['helpers_dir'] . 'form_sanitizer.php';


function index(): void
{
    $title = "Connexion";
    $desc = "Veuillez vous connecter pour accéder à l'espace d'administration.";

    // Vérifier si l'utilisateur est déjà connecté
    if (isset($_SESSION['user'])) {
        $_SESSION['errorMessage'] = 'Un utilisateur est déjà connecté.';
        header('Location: /');
        exit;
    }

    require_once $GLOBALS['partials_dir'] . 'header.php';
    require_once $GLOBALS['view_dir'] . 'connexion_view.php';
    require_once $GLOBALS['partials_dir'] . 'footer.php';
}


function formHandle(): void
{

    // Gérer la soumission du formulaire de connexion
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = sanitizeInput($_POST['username']) ?? '';
        $password = sanitizeInput($_POST['password']) ?? '';
        if (isset($_POST['remember_me']) && $_POST['remember_me'] == 'on') {
            $remember = true;
        } else {
            $remember = false;
        }

        $response = login_user($username, $password, $remember);

        if ($response['success']) {

            if ($_SERVER['REQUEST_SCHEME'] === 'https') {
                $cookieName = 'remember_user_token_sae202';
                $expiration = time() + (86400 * 10); // 10 jours
                $path = '/'; // Disponible sur tout le site
                $domain = $GLOBALS['siteDomain'] ?? ''; // Utiliser le domaine du site si défini
                $secure = true; // IMPORTANT: N'envoyer le cookie qu'en HTTPS
                $httponly = true; // IMPORTANT: Empêche l'accès au cookie via JavaScript (XSS)
                $samesite = 'Lax'; // Ajouté pour la sécurité (Strict, Lax, None)

                setcookie($cookieName, $response['token'], [
                    'expires' => $expiration,
                    'path' => $path,
                    'domain' => $domain, // Si vide, le domaine courant sera utilisé
                    'secure' => $secure,
                    'httponly' => $httponly,
                    'samesite' => $samesite
                ]);
            }

            $_SESSION['user'] = $response['user'];
            $_SESSION['successMessage'] = 'Connexion réussie.';
            header('Location: /', true, 302);
            exit;
        } else {
            $_SESSION['errorMessage'] =  $response['message'];;
            header('Location: /connexion');
            exit;
        }
    } else {
        $_SESSION['errorMessage'] = 'Méthode de requête non autorisée.';
        header('Location: /connexion');
        exit;
    }
}

function logout(): void
{
    global $siteDomain;
    unset($_SESSION['user']);
    // Supprimer le cookie de connexion si l'utilisateur a choisi de rester connecté
    if (isset($_COOKIE['remember_user_token_sae202'])) {
        setcookie('remember_user_token_sae202', '', time() - 3600, '/', $siteDomain, true, true); // Expire le cookie
    }
    $_SESSION['successMessage'] = 'Déconnexion réussie.';
    header('Location: /', true, 302);
    exit;
}
