<?php

$pageTitle = 'Vue du message';
$pageDescription = 'Page de vue du site de réservation de cinéma.';
require_once "queries/messages.php";

$id = $_GET['id'] ?? '';
$message = getOneMessage($id);

require_once __DIR__ . '/partials/header.php';
?>
<div class="container mx-auto px-4 py-8 flex flex-wrap !items-start  gap-6 justify-between ">

    <div class=" self-start  grid grid-cols-1 md:grid-cols-2  gap-6  bg-white rounded-lg shadow-xs dark:bg-gray-800 p-6 ">
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">ID du message</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?= htmlspecialchars($message['id'] ?? 'Inconnu', ENT_QUOTES, 'UTF-8') ?></p>
        </div>

        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Auteur</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?= htmlspecialchars($message['author'] ?? 'Inconnu', ENT_QUOTES, 'UTF-8') ?></p>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Destinataire</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?= htmlspecialchars($message['destinataire'] ?? 'Inconnu', ENT_QUOTES, 'UTF-8') ?></p>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Email</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?= htmlspecialchars($message['email'] ?? 'Inconnu', ENT_QUOTES, 'UTF-8') ?></p>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Date</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?= htmlspecialchars($message['date'] ?? 'Inconnue', ENT_QUOTES, 'UTF-8') ?></p>
        </div>
    </div>
    <div class=" flex-1 flex  flex-col flex-wrap  p-6 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h3 class="dark:text-gray-200  mb-8">Contenu</h3>
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?= nl2br($message['contenu']) ?></p>


    </div>
    <div class="mt-6 flex-[100%] flex justify-end">
        <span class="text-gray-600"><?= $message['is_replied'] ;?></span>

        <?php if($message['is_replied'] > 0): ?>
            <span class="text-red-600 font-semibold mr-4">Ce message a déjà été répondu.</span>
        <?php else: ?>
            <a href="/admin/messages_action.php?action=reply&id=<?= $message['id'] ?>" class="text-green-600 hover:text-green-900 mr-4">Répondre</a>
        <?php endif; ?>
        <a href="/admin/messages_manage.php" class="text-blue-600 hover:text-blue-900">Retour à la liste des messages</a>
    </div>


</div>