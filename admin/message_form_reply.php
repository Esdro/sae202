<?php

$id = $_GET['id'] ?? '';
$pageTitle =  'Répondre au message' ;
$pageDescription = 'Page de réponse à un message du site de réservation de cinéma.';
require_once "queries/messages.php";
require_once "queries/users.php";

$adminInfos = getAdminInfos();
$message = getOneMessage($id);

require_once __DIR__ . '/partials/header.php';
?>
<div class="container mx-auto px-4 py-8 flex flex-wrap !items-start  gap-6 justify-between ">

<?php if($message): ?>
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
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Email</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?= htmlspecialchars($message['email'] ?? 'Inconnu', ENT_QUOTES, 'UTF-8') ?></p>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Date</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?= htmlspecialchars($message['date'] ?? 'Inconnue', ENT_QUOTES, 'UTF-8') ?></p>
        </div>

         <div class=" flex-1 flex  flex-col flex-wrap  p-6 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h3 class="dark:text-gray-200  mb-8">Contenu</h3>
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?= $message['contenu'] ?></p>
    </div>

    </div>

    <?php endif; ?>

    <div class="mt-6 flex-auto flex  flex-col flex-wrap  p-6 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h3 class="dark:text-gray-200  mb-8 text-4xl">Répondre</h3>

        <form action="/admin/messages_form_handle.php" method="post">
            <input type="hidden" name="reply_id" value="<?php echo htmlspecialchars($message['id'], ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="date_envoi" value="<?= date('Y-m-d H:i:s') ?>">
            <input type="hidden" name="destinataire" value="<?php echo htmlspecialchars($message['author_id'], ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($adminInfos['id'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="mb-4">
                <label for="contenu" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Votre message</label>
                <textarea name="contenu" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700" required></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-600">Envoyer</button>
            </div>
        </form>

    </div>
   



</div>