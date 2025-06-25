<?php


require_once $GLOBALS['model_dir'] . "avis_model.php";
require_once $GLOBALS['model_dir'] . "user_model.php";
require_once $GLOBALS['helpers_dir'] . "form_sanitizer.php";




function index(): void
{

    $title = "Mes avis";
    $desc = "Gérez vos avis.";

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        $_SESSION['errorMessage'] = 'Vous devez être connecté pour accéder à cette page.';
        header('Location: /connexion');
        exit;
    }
    $user = $_SESSION['user'];

    $mesAvis = getUserAvis($user['id']);
   
    $avisPublished = getAllPublishedAvis();

    $allPublishedAvis =  array_filter($avisPublished, function ($avis) {
        return $avis['username'] !== $_SESSION['user']['username'];
    });
   

    // var_dump($allPublishedAvis);
    // die();


    require_once $GLOBALS['partials_dir'] . 'header.php';
    require_once $GLOBALS['view_dir'] . 'avis_view.php';
    require_once $GLOBALS['partials_dir'] . 'footer.php';
}




// Route pour traiter la création d'un commentaire : /comments/add
function add(): void
{

    $title = "Ajouter un avis";
    $desc = "Ajoutez un nouvel avis .";


    $user = $_SESSION['user'];
    // Vérifier si l'utilisateur existe
    if (!$user) {
        $_SESSION['errorMessage'] = 'Utilisateur non trouvé.';
        header('Location: /avis');
        exit;
    }

    // vérifier la méthode de la requête
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Vérifier si le contenu du commentaire est présent
        $data = sanitizeArray($_POST?? '');
//        var_dump($data);
//        die();
        if (empty($data)) {
            $_SESSION['errorMessage'] = 'Le contenu de votre formulaire ne peut pas être vide.';
            header('Location: /avis/add');
            exit;
        }

        $data['user_id'] = (int) $data['user_id'] ;

        // Créer l'avis
        $result = createAvis($data);

        if ($result['success']) {
            $_SESSION['successMessage'] = $result['message'];
            header('Location: /avis');
            exit;
        } else {
            $_SESSION['errorMessage'] = $result['message'];
            header('Location: /avis/add');
            exit;
        }
    }

    require_once $GLOBALS['partials_dir'] . 'header.php';
    require_once $GLOBALS['view_dir'] . 'avi_add_view.php';
    require_once $GLOBALS['partials_dir'] . 'footer.php';
}

// Route pour afficher un commentaire spécifique : /avis/view?id=1
function view(): void
{
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        $_SESSION['errorMessage'] = 'Vous devez être connecté pour voir les commentaires.';
        header('Location: /connexion');
        exit;
    }

    // Vérifier si l'ID du commentaire est fourni
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        $_SESSION['errorMessage'] = 'ID  invalide.';
        header('Location: /avis');
        exit;
    }

    $avisId = (int)$_GET['id'];
    $avis = getAvisById($avisId);

    if (!$avis) {
        $_SESSION['errorMessage'] = 'Avis non trouvé.';
        header('Location: /avis');
        exit;
    }

    require_once $GLOBALS['partials_dir'] . 'header.php';
    require_once $GLOBALS['view_dir'] . 'avi_view.php';
    require_once $GLOBALS['partials_dir'] . 'footer.php';
}

// Route pour supprimer un commentaire : /avis/delete?id=1
function delete(): void{

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        $_SESSION['errorMessage'] = 'Vous devez être connecté pour supprimer un avis.';
        header('Location: /connexion');
        exit;
    }

    // Vérifier si l'ID du commentaire est fourni
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        $_SESSION['errorMessage'] = 'ID de commentaire invalide.';
        header('Location: /avis');
        exit;
    }

    $avisId = (int)$_GET['id'];
    $result = deleteAvis($avisId);

    if ($result['success']) {
        $_SESSION['successMessage'] = $result['message'];
    } else {
        $_SESSION['errorMessage'] = $result['message'];
    }

    header('Location: /avis');
    exit;
}

// Route pour mettre à jour un commentaire : /avis/edit?id=1
function edit(): void
{
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        $_SESSION['errorMessage'] = 'Vous devez être connecté pour modifier un commentaire.';
        header('Location: /connexion');
        exit;
    }

    // Vérifier si l'ID du commentaire est fourni
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        $_SESSION['errorMessage'] = 'ID de commentaire invalide.';
        header('Location: /avis');
        exit;
    }

    $avisId = (int)$_GET['id'];
    $avis = getAvisById($avisId);

    if (!$avis) {
        $_SESSION['errorMessage'] = 'Avis non trouvé.';
        header('Location: /avis');
        exit;
    }

    // Vérifier la méthode de la requête
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = sanitizeArray($_POST ?? '');
        if (empty($data)) {
            $_SESSION['errorMessage'] = 'Le contenu du commentaire ne peut pas être vide.';
            header('Location: /avis/edit?id=' . $avisId);
            exit;
        }

        $result = updateAvis($data);

        if ($result['success']) {
            $_SESSION['successMessage'] = $result['message'];
            header('Location: /avis/view?id=' . $avisId);
            exit;
        } else {
            $_SESSION['errorMessage'] = $result['message'];
            header('Location: /avis/edit?id=' . $avisId);
            exit;
        }
    }

    require_once $GLOBALS['partials_dir'] . 'header.php';
    require_once $GLOBALS['view_dir'] . 'avis_edit_view.php';
    require_once $GLOBALS['partials_dir'] . 'footer.php';
}
