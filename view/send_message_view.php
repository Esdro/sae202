
<div class="messagerie_form_container">
    <h2>Envoyer un message</h2>

    <form action="/messagerie/send" method="post" class="messagerie_form">
        <div class="form-group">
            <label for="destinataire">Destinataire :</label>
         
            <select id="destinataire" name="destinataire" required>
                <option value="" disabled selected>Choisissez un destinataire</option>
                <?php foreach ($adminUsers as $user): ?>
                    <option value="<?= htmlspecialchars($user['user_id']) ?>"><?= htmlspecialchars($user['username']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="contenu">Contenu :</label>
            <textarea id="contenu" name="contenu" rows="4" required></textarea>
        </div>

        <button type="submit" class="action-button">Envoyer</button>
    </form>
</div>