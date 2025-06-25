<?php

function index() : void {
    $title = "Infos pratiques";
    $desc = "Ici vous trouverez les informations pratiques du jeu Disco";
    require_once $GLOBALS['partials_dir'] . 'header.php';
    require_once $GLOBALS['view_dir'] . 'infos-pratiques_view.php';
    require_once $GLOBALS['partials_dir'] . 'footer.php';
    
}