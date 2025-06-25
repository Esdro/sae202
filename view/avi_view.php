<div class="comment_view_container">
    <p><?= nl2br($avis['content']) ?></p>
    <p><em>Publié le <?= htmlspecialchars($avis['date']) ?></em></p>
    <p><strong>Évaluation:</strong> <?= htmlspecialchars($avis['rate']) ?> étoiles</p>
    <div class="comment_actions">
        <a href="/avis/edit?id=<?= $avis['id'] ?>" class="action-button">Modifier</a>
        <a href="/avis/delete?id=<?= $avis['id'] ?>" class="action-button">Supprimer</a>
    </div>
</div>