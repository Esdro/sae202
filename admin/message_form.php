<?php

$pageTitle = 'Envoyer un message';
$pageDescription = 'Page d\'envoie de message du site de réservation de cinéma.';
require_once "queries/messages.php";
require_once "queries/users.php";

$emailAdmin = getAdminInfos();

$allUsers = getNonAdminUsers();

require_once __DIR__ . '/partials/header.php';
?>
<div class="container mx-auto px-4 py-8 flex flex-wrap !items-center  gap-6 justify-between ">

    <div class="  w-full max-w-screen-md mx-auto bg-white rounded-lg shadow-xs dark:bg-gray-800 p-6 ">
        <form action="/admin/messages_form_handle.php" method="post">

        <input type="hidden" name="date_envoi" value="<?= date('Y-m-d H:i:s') ?>">



            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Le destinataire</label>
                <select name="destinataire" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700" required>
                    <option value="">Sélectionnez un utilisateur</option>
                    <?php foreach ($allUsers as $user): ?>
                        <option value="<?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></option>
                    <?php endforeach; ?>
                </select>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Assurez-vous de sélectionner un utilisateur valide ou d'en créer un.</p>
            </div>

            <input type="hidden" name="user_id" value="<?= htmlspecialchars($emailAdmin['id'], ENT_QUOTES, 'UTF-8') ?>">


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