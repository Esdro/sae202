<?php

function index() : void {
    $title = "Le concept du jeu";
    $desc = "Ici vous trouverez le concept du jeu Disco Murder";
    require_once $GLOBALS['partials_dir'] . 'header.php';
    require_once $GLOBALS['view_dir'] . 'concept_view.php';
    require_once $GLOBALS['partials_dir'] . 'footer.php';
    
}