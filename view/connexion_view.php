<div class="intro">
  <!-- Logo illustratif (non décoratif) -->
  <div class="intro-svg">
    <img src="/images/logo_desktop.svg" alt="Logo de l'événement">
  </div>
  
  <div class="form-container">

  <div class="brand-logo">
      <h2>Connexion</h2>
  </div>
    <form action="/connexion/formHandle" method="post">

        <div class="form-control_username">
            <input type="text" id="username" name="username" required placeholder="E-mail">
        </div>

        <div class="form-control_password">
            <input type="password" id="password" name="password" required placeholder="Mot De Passe">
        </div>
        <div class="form-control_submit-connect">
            <button type="submit">Connexion</button>
        </div>
    </form>
</div>