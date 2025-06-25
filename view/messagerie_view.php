<div class="messagerie_container">
    <h1 id="concept">Messagerie</h1>

    <div class="flexing">
        <h2>Messages envoyés</h2>
    </div>
    <div class="messagerie-box">
        <div class=" left-content">

            <div class="messages_list <?php if (empty($messages)): ?> empty <?php endif; ?>">
                <?php if (empty($messages)): ?>
                    <p>Aucun message trouvé.</p>
                    <a href="/messagerie/send" class="button_compose_message">Composer un message</a>

                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Expéditeur</th>
                                <th>Destinataire</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($messages as $message): ?>
                                <tr class="<?= 'non_lu' == $message['statut'] ? 'unread' : 'read'; ?>">
                                    <td><?= htmlspecialchars($message['author']) . " (Vous)" ?></td>
                                    <td><?= htmlspecialchars($message['destinataire']) ?></td>
                                   
                                    <td class="action-buttons">
                                        <a href="/messagerie/view?id=<?= $message['id'] ?>" class="action-button_view">Voir</a>
                                        <a href="/messagerie/delete?id=<?= $message['id'] ?>" class="action-button_delete">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="flexing">
        <h2>Messages reçus</h2>
    </div>
    <div class="messagerie-box">
        <div class=" left-content">

            <div class="messages_list <?php if (empty($receivedMessages)): ?> empty <?php endif; ?>">
                <?php if (empty($receivedMessages)): ?>
                    <p>Aucun message trouvé.</p>
                    <a href="/messagerie/send" class="button_compose_message">Composer un message</a>

                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Expéditeur</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($receivedMessages as $message): ?>
                                <tr class="<?= 'non_lu' == $message['statut'] ? 'unread' : 'read'; ?>">
                                    <td><?= htmlspecialchars($message['username']) ?></td>
                                    <td><?= htmlspecialchars($message['statut']) ?></td>
                                    <td class="action-buttons">
                                        <a href="/messagerie/view?id=<?= $message['id'] ?>" class="action-button_view">Voir</a>
                                      
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>