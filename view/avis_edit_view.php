<div class="comment_edit_container">
    <h1>Modifier le Commentaire</h1>
    <form method="post" action="/avis/edit?id=<?= $avis['id'] ?>" class="form-container">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($avis['user_id']) ?>">
        <input type="hidden" name="avi_id" value="<?= htmlspecialchars($avis['id']) ?>">

        <div class="form_group">
            <label for="rate">Nombre d'étoiles :</label>
            <input type="range" id="rate" name="rate" max="5" min="1" step="1" value="<?= $avis['rate'] ?>" required>
        </div>
        <div class="form_group">
            <label for="content">Contenu:</label>
            <textarea id="content" name="content" required><?= $avis['content'] ?></textarea>
        </div>
        <button type="submit" class="submit_button">Mettre à jour</button>
    </form>
</div>
