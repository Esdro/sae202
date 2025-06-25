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
    <meta name="author-url" content="mmi24f07.mmi-troyes.fr, mmi24e12.mmi-troyes.fr">
    <meta name="author-email" content="mmi24f07@mmi-troyes.fr, mmi24e12@mmi-troyes.fr, mmi24b09@mmi-troyes.fr, mmi24h06@mmi-troyes.fr, mmi24c07@mmi-troyes.fr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
   <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Lien canonique -->
    <link rel="canonical" href="<?= $canonicalUrl; ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= $title; ?>">
    <meta property="og:description" content="<?= $site_description; ?>">
    <meta property="og:image" content="<?= $ogImage; ?>">
    <meta property="og:url" content="<?= $canonicalUrl; ?>">
    <meta property="og:type" content="website">
    <link rel="stylesheet" href="view/partials/css/header.css">
    <link rel="shortcut icon" href="<?= $favicon; ?>" type="image/x-icon">
</head>

<body>
    

<section>
  <div class="mx-auto max-w-screen-2xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
      <div class="bg-blue-600 p-8 md:p-12 lg:px-16 lg:py-24">
        <div class="mx-auto max-w-xl text-center">
          <h2 class="text-2xl font-bold text-white md:text-3xl">
            <?= $title; ?>
          </h2>

          <p class="hidden text-white/90 sm:mt-4 sm:block">
            <?= $site_description; ?>
          </p>

          <div class="mt-4 md:mt-8">
            <a
              href="/"
              aria-label="Retour à l'accueil"
              class="inline-block rounded-sm border border-white bg-white px-12 py-3 text-sm font-medium text-blue-500 transition hover:bg-transparent hover:text-white focus:ring-3 focus:ring-yellow-400 focus:outline-hidden"
            >
             Retour à l'accueil
            </a>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4 md:grid-cols-1 lg:grid-cols-2">
        <img
          alt=""
          src="https://images.unsplash.com/photo-1621274790572-7c32596bc67f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=654&q=80"
          class="h-40 w-full object-cover sm:h-56 md:h-full"
        />

        <img
          alt=""
          src="https://images.unsplash.com/photo-1567168544813-cc03465b4fa8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80"
          class="h-40 w-full object-cover sm:h-56 md:h-full"
        />
      </div>
    </div>
  </div>
</section>
</body>
</html>