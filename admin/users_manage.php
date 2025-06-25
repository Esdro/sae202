<?php

$pageTitle = 'Gestion des utilisateurs';
$pageDescription = 'Page de gestion des utilisateurs du site de réservation de cinéma.';
require_once "queries/users.php";
$users = getUsers();

require_once __DIR__ . '/partials/header.php';
?>

<div class="w-full overflow-hidden rounded-lg shadow-xs mt-8">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700">
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Nom</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Rôle</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php foreach ($users as $user) : ?>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3"><?= htmlspecialchars($user['id']) ?></td>
                    <td class="px-4 py-3"><?= htmlspecialchars($user['username']) ?></td>
                    <td class="px-4 py-3"><?= htmlspecialchars($user['email']) ?></td>
                    <td class="px-4 py-3"><?= htmlspecialchars($user['role']) ?></td>
                    <td class="px-4 py-3">
                        <a href="/admin/user_edit.php?id=<?= htmlspecialchars($user['id']) ?>" class="text-blue-600 hover:underline">Modifier</a>
                        <a href="/admin/user_delete.php?id=<?= htmlspecialchars($user['id']) ?>" class="text-red-600 hover:underline">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

    <div class="mt-6 flex justify-end">
        <a href="/admin/user_add.php" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-600">
            Ajouter un utilisateur
        </a>
    </div>
</div>
