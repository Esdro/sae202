<?php


$pageTitle = "Modifier les infos de l'utilisateur";
$pageDescription = "Page de modification des informations d'un utilisateur du site.";

require_once "queries/users.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['errorMessage'] = "ID d'utilisateur invalide.";
    header("Location: /admin/users_manage.php");
    exit;
}

$user = getUserById($_GET['id']);
if (!$user) {
    $_SESSION['errorMessage'] = "Utilisateur introuvable.";
    header("Location: /admin/users_manage.php");
    exit;
}

require_once __DIR__ . '/partials/header.php';
?>

<div class="max-w-2xl mx-auto w-full mt-8">
    <?php if (isset($_SESSION['errorMessage'])): ?>
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <?= htmlspecialchars($_SESSION['errorMessage']) ?>
            <?php unset($_SESSION['errorMessage']); ?>
        </div>
    <?php endif; ?>

    <form action="/admin/user_edit_handle.php" method="POST" class="space-y-4 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md  max-w-screen-md w-full mx-auto  ">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

        <div>
            <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required class="mt-1 block w-full border-gray-300 rounded-md border-1  focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-200 p-2">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required class="mt-1 block w-full border-gray-300 rounded-md border-1 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-200 p-2">
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rôle</label>
            <select id="role" name="role"
                class="mt-1 block w-full border-gray-300 rounded-md border-1 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-200 p-2">
                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>Utilisateur</option>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Administrateur</option>
            </select>
        </div>

        <button type="submit"
            class="w-full inline-flex justify-center mt-6  py-2 px-4 border border-transparent rounded-md text-md font-medium cursor-pointer text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Enregistrer les modifications
        </button>

    </form>
</div>

<?php
require_once __DIR__ . '/partials/footer.php';
