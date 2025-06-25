<div class="intro">
  <!-- Logo illustratif (non décoratif) -->
  <div class="intro-svg">
    <img src="/images/logo_desktop.svg" alt="Logo de l'événement">
  </div>
  
  <div class="form-container">

  <div class="brand-logo">
      <h2>Inscription </h2>
  </div>
    <form action="/inscription/formHandle" method="post">

        <div class="form-control_email">
            <input type="email" id="email" name="email" required placeholder="Nom">
        </div>
        <div class="form-control_username">
            <input type="text" id="username" name="username" required placeholder="E-mail">
        </div>

        <div class="form-control_password">
            <input type="password" id="password" name="password" required placeholder="Mot De Passe">
        </div>
        <div class="form-control_submit">
            <button type="submit">S'inscrire</button>
        </div>
    </form>
</div>