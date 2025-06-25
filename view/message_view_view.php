<div class="messagerie_container">
<h1 id="concept">Message</h1>
  
    <div class="view_message_container">
        <div class="message_details">
            <p><strong>Destinataire:</strong> <?= htmlspecialchars($message['destinataire']) ?></p>
            <p><strong>Date d'envoi:</strong> <?= htmlspecialchars($message['date_envoi']) ?></p>
            <div class="message_content">
                <?= nl2br($message['contenu']) ?>
            </div>
        </div>

        <div class="action-buttons">
            <a href="/messagerie" class="action-button_back">Retour à la messagerie</a>

            <?php if ($message['author'] === $_SESSION['user']['username']): ?>
                <a href="/messagerie/delete?id=<?= $message['id'] ?>" class="action-button_delete">Supprimer</a>
            <?php endif; ?>


        </div>
    </div>


</div>