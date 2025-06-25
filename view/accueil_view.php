<div class="intro">
  <!-- Logo illustratif (non décoratif) -->
  <div class="intro-svg">
    <img src="/images/logo_desktop.svg" alt="Logo de l'événement">
  </div>

  <h1 id="concept">Une enquête sur le dancefloor</h1>
  <p>
    Plongez dans l’ambiance envoûtante des années 60 le temps d’une soirée pas comme les autres. 
    Entre musique rétro, looks vintage et secrets bien gardés, un crime viendra bouleverser la fête. 
    À vous de mener l’enquête : interrogez, fouillez, accusez… et découvrez la vérité avant qu’il ne soit trop tard.
  </p>
</div>

<!-- Séparateurs colorés -->
<div class="separators" aria-hidden="true">
  <hr class="ligne bleu">
  <hr class="ligne jaune">
  <hr class="ligne orange">
  <hr class="ligne rouge">
  <hr class="ligne marron">
</div>



<!-- Contenu complémentaire -->
<div class="contenu">
  <h2 id="trailer">Trailer</h2>
  <!-- (Tu peux ajouter ici une iframe vidéo ou une image de bande-annonce) -->

  <div class="avis-header">
  <h2 id="avis">Vos avis</h2>
  <a href="/avis" class="btn-voir-plus">Voir plus d’avis</a>
</div>

<div class="avis-liste">
  <?php if ($publishedAvis): ?>
    <?php foreach ($publishedAvis as $avis): ?>
      <div class="avis-box">
        <div class="rating-box">
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="avis-rate star <?= $i <= $avis['rate'] ? 'filled' : '' ?>">★</span>
          <?php endfor; ?>
        </div>
        <p><?= htmlspecialchars($avis['username']) ?></p>
        <p><?= $avis['content'] ?></p>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Aucun avis publié trouvé.</p>
  <?php endif; ?>
</div>

<div class="avis-button-container">
  <a href="/avis/add" class="avis-button">Laisser un avis</a>
</div>

<section class="newsletter-section">
  <h2 id="newsletter">Newsletters</h2>
  <div class="newsletter-button-container">
    <button class="newsletter-button-contenu">Inscrivez-vous pour recevoir nos dernières actualités.</button>
  </div>
</section>

</div>

