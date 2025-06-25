<?php


$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Retirer le slash initial et final

$url = trim($url, '/');

// Diviser l'URL en segments
$items = explode('/', $url);

// var_dump($items); // Pour déboguer, à supprimer en production


// Obtenir le contrôleur et l'action à partir de l'URL
$controller = !empty($items[0]) ? $items[0] : 'accueil';
$action = !empty($items[1]) ? $items[1] : 'index';



// vérifier l'action 2 
if (isset($items[2]) && !empty($items[2])) {
    $action = $items[2];
}

if ($controller === 'gestion') {
    // Authentification gérée par Apache (REMOTE_USER)
    if (empty($_SERVER['REMOTE_USER'])) {
        $title = 'Accès refusé';
        $desc = 'Authentification requise 2 ';
        include $GLOBALS['controller_dir']  .  'error_403.php';
        exit;
    }

    $_SESSION['db_user'] = $_SERVER['REMOTE_USER'];

    include $GLOBALS['admin_dir'] . 'index.php';
    if (function_exists($action)) {
        call_user_func($action);
    } else {
        $title = 'Erreur 500';
        $desc = 'L\'action demandée n\'est pas encore implémentée';
        include $GLOBALS['controller_dir']  .  'error_404.php';
    }
    exit;
}

// Inclure le fichier de contrôleur approprié
$controllerFile =  $GLOBALS['controller_dir'] . $controller . '_controller.php';
if (file_exists($controllerFile)) {
    include $controllerFile;
    if (function_exists($action)) {
        call_user_func($action);
    } else {

        $title = 'Erreur 404';
        $desc = 'L\'action demandée n\'est pas encore implémentée';
        include $GLOBALS['controller_dir']  .  'error_404.php';
    }
} else {
    $title = 'Erreur 404';
    $desc = 'Page non trouvée';
    include $GLOBALS['controller_dir']  .  'error_404.php';
}
