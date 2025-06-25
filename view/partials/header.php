<?php

$site_description =  (isset($desc) && ! empty($desc)) ?  $desc . $GLOBALS['description_end'] : $GLOBALS['site_description'];

$title =  isset($title) ? $title . "  | Disco Murder by Ollie " : '  Disco Murder by Ollie ';

// Utiliser la variable globale si la variable n'a pas été surchargée
if (!isset($canonicalUrl) && isset($GLOBALS['canonicalUrl'])) {
    $canonicalUrl = $GLOBALS['canonicalUrl'];
}
if (!isset($ogImage) && isset($GLOBALS['ogImage'])) {
    $ogImage = $GLOBALS['ogImage'];
}

if (!isset($favicon) && isset($GLOBALS['favicon'])) {
    $favicon = $GLOBALS['favicon'];
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $site_description ?>">
    <meta name="author" content="Esdras Onionkiton, Ethan Mauclair, Matthis Chhour, Mélissa Toumazet, Mohamad Edelbi">
    <meta name="author-url" content="mmi24f07.mmi-troyes.fr, mmi24e12.mmi-troyes.fr, mmi24h06.mmi-troyes.fr, mmi24c07.mmi-troyes.fr">
    <meta name="author-email" content="mmi24f07@mmi-troyes.fr, mmi24e12@mmi-troyes.fr, mmi24b09@mmi-troyes.fr, mmi24h06@mmi-troyes.fr, mmi24c07@mmi-troyes.fr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>

    <!-- Lien canonique -->
    <link rel="canonical" href="<?= $canonicalUrl; ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= $title; ?>">
    <meta property="og:description" content="<?= $site_description; ?>">
    <meta property="og:image" content="<?= $ogImage; ?>">
    <meta property="og:url" content="<?= $canonicalUrl; ?>">
    <meta property="og:type" content="website">

    <link rel="stylesheet" href="/view/partials/css/globales.css">
    <link rel="stylesheet" href="/view/partials/css/header-ethan.css">
    <link rel="stylesheet" href="/view/partials/css/style-esdras.css">
    <link rel="stylesheet" href="/view/partials/css/profile.css">
    <link rel="shortcut icon" href="<?= $favicon; ?>" type="image/x-icon">


</head>

<body>
    <header class="main-header">
        <div class="header-top">
            <!-- Logo Mobile -->
            <a href="/" class="logo_mobile" aria-label="Accueil">
                <img src="/images/logo_mobile.svg" alt="Logo mobile du site">
            </a>

            <!-- Logo Desktop -->
            <a href="/" class="logo_desktop" aria-label="Accueil">
                <img src="/images/logo_desktop.svg" alt="Logo desktop de l'événement">
            </a>

            <!-- Bouton Menu -->
            <button class="menu-button" aria-label="Menu principal">
                <img src="/images/menu_hamburger.svg" alt="Icône menu hamburger" width="33" height="29">
            </button>
        </div>

        <!-- Liens Connexion / Inscription (desktop uniquement) -->
        <div class="account-links desktop-only">
            <?php if (!isset($_SESSION['user'])): ?>
                <a href="/connexion" class="login-link">
                    <img src="/images/menu_hamburger.svg" alt="Icône connexion" class="icon">
                    Connexion
                </a>
                <a href="/inscription" class="signup-link">
                    <img src="/images/couteau_picto.svg" alt="Icône inscription" class="icon">
                    Inscription
                </a>
            <?php else: ?>
                <a href="/profile" class="messages-link">
                    Mon compte
                </a>
                <a href="/connexion/logout" class="logout-link">
                    <img src="/images/menu_hamburger.svg" alt="Icône déconnexion" class="icon">
                    Déconnexion
                </a>
            <?php endif; ?>


        </div>

        <!-- Menu de navigation principal -->
        <nav class="main-nav">
            <ul>
                <li><a href="/">Accueil</a></li>
                <li><a href="/concept">Concept</a></li>
                <li><a href="/infos-pratiques">Infos pratiques</a></li>
                <li><a href="/agence" target="_blank" rel="noopener">Ollie Agence</a></li>
                <?php if (isset($_SESSION['user'])): ?>
                    <li>
                        <a href="/messagerie" class="messages-link">
                            Messagerie
                        </a>
                    </li>
                    <li class="mobile-only"><a href="/profile">Mon compte</a></li>
                    <li class="mobile-only"><a href="/connexion/logout">Déconnexion</a></li>
                <?php else: ?>
                    <li class="mobile-only"><a href="/connexion">Connexion</a></li>
                    <li class="mobile-only"><a href="/inscription">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <!-- SVG décoratif sous le header -->
    <div class="header-divider" aria-hidden="true">
        <svg width="393" height="144" viewBox="0 0 393 144" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M99.6875 -67C128.539 -67 154.649 -57.4704 173.502 -42.0781C199.988 -53.7354 237.365 -60.9999 278.787 -61C359.102 -61 424.211 -33.6894 424.211 0C424.211 2.0861 423.96 4.14748 423.473 6.17969C432.251 14.5565 437.478 25.0759 437.478 36.5C437.478 63.2076 408.915 84.974 373.177 85.9639C362.584 112.551 339.383 131 312.465 131C289.323 131 268.928 117.365 256.93 96.6455C244.797 106.693 227.307 113 207.862 113C184.646 113 164.215 104.009 152.363 90.3955C136.911 97.7696 118.908 102 99.6875 102C97.7139 102 95.7531 101.953 93.8066 101.865C83.3317 126.708 59.976 144 32.8438 144C-4.07299 144 -34 111.988 -34 72.5C-34 47.6959 -22.1919 25.8421 -4.26074 13.0186C-1.39084 -31.5661 44.0507 -67 99.6875 -67Z" fill="#521C0D" />
        </svg>
    </div>

    <main class="container">
        <div class="flash-messages">
            <?php
            // Afficher les messages de session
            if (isset($_SESSION['successMessage'])) {
                echo '<div class="success-message">' . $_SESSION['successMessage'] . '</div>';
                unset($_SESSION['successMessage']);
            }
            if (isset($_SESSION['errorMessage'])) {
                echo '<div class="error-message">' . $_SESSION['errorMessage'] . '</div>';
                unset($_SESSION['errorMessage']);
            }
            ?>
        </div>