<div class="change_password_container">
    <h2>Changer de mot de passe</h2>
    <form method="post" action="/profile/change_password" class="form-container">
        <div class="form-group">
            <label for="current_password">Mot de passe actuel:</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>
        <div class="form-group">
            <label for="new_password">Nouveau mot de passe:</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirmer le nouveau mot de passe:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit">Changer le mot de passe</button>
    </form>
</div>