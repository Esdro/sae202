<?php
// mettre la date et l'heure par défaut
date_default_timezone_set('Europe/Paris');

// Démarrer la session
session_start();

// mettre en place un cookie de session avec une durée de vie de 1h avec le nom 'sae202_id'
// setcookie('sae202_id', session_id(), time() + 3600, '/');





// les variables globales
$site_description = "Projet SAE202 2025 à l'IUT de Troyes - Agence Ollie - Esdras Onionkiton, Ethan Mauclair, Matthis Chhour, Mélissa Toumazet, Mohamad Edelbi";
$description_end = "  -  Agence Ollie , SAE202 2025, IUT de Troyes";
$siteDomain = 'mmi24f07.sae202.ovh';
$siteEmail  = 'mmi24f07@mmi-troyes.fr';
$canonicalUrl = 'https://mmi24f07.sae202.ovh';
$ogImage = 'https://mmi24f07.sae202.ovh/agence/wp-content/uploads/2025/06/e1c4b62ae9f2dcc8bf583d2844c00961bb751246-scaled.png';
$favicon = "https://mmi24f07.sae202.ovh/agence/wp-content/uploads/2025/06/cropped-Favicon__Ollie.png";

$directory = __DIR__ . "/";
$conf_dir = $directory . 'conf/';
$controller_dir = $directory . 'controller/';
$model_dir = $directory . 'model/';
$admin_dir = $directory . 'admin/';
$view_dir = $directory . 'view/';
$partials_dir = $view_dir . 'partials/';
$helpers_dir = $directory . 'helpers/';

$possibleAdminUsers = [
    'mmi24f07',
    'mmi24e12',
    'mmi24h06',
    'mmi24c07',
    'mmi24b09'
];






//vérifier si le cookie de session existe
if (!isset($_SESSION['user']) && isset($_COOKIE['remember_user_token_sae202'])) {

    // Si le cookie existe, on peut essayer de récupérer l'utilisateur
    $navigator_token = $_COOKIE['remember_user_token_sae202'];

    require_once 'model/user_model.php';

    $user = getUserByToken($navigator_token);

    if ($user) {

        $db_token = $user['token'];

     
        // Vérifier si le token du cookie correspond à celui de la base de données (les deux sont déjà hachés)
        if ($db_token && hash_equals($db_token, $navigator_token)) {

            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

          //  var_dump($_SESSION['user']);

            // générer un nouveau token pour la session
            $newToken = bin2hex(random_bytes(32));
            $newHashedToken = password_hash($newToken, PASSWORD_DEFAULT);

            // Mettre à jour le token dans la base de données
            updateUserToken($user['id'], $newHashedToken);

            // Mettre à jour le cookie avec le nouveau token
            setcookie('remember_user_token_sae202', $newToken, time() + (86400 * 10), '/', '', true, true);


            $_SESSION['successMessage'] = 'Connexion réussie via le cookie.';
        } else {
            // Si le token ne correspond pas, on supprime le cookie
            setcookie('remember_user_token_sae202', '',  time() - 3600, '/', '', true, true);
        }
    } else {
        // Si l'utilisateur n'existe pas, on supprime le cookie
        setcookie('remember_user_token_sae202', '', time() - 3600, '/');
    }
}



require_once  $conf_dir . 'routeur.php';
