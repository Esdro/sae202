<?php

$pageTitle = 'Administration';
$pageDescription = 'Page d\'administration du site de réservation de cinéma.';

require_once "queries/avis.php";
require_once "queries/users.php";
require_once "queries/reservations.php";
require_once "queries/messages.php";
require_once "queries/events.php";

$event = getEventBySearch("Disco Murder");

require_once __DIR__ . '/partials/header.php';

?>

<h3 class="text-2xl font-semibold mb-4 dark:text-white">Statistiques</h3>

<div class="grid gap-6 mb-8 grid-cols-1 md:grid-cols-2">
    <!-- Card -->
    <div
       class="flex items-center p-8 flex-wrap  gap-y-8   bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div
            class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
            </svg>
        </div>
        <div>
            <p
                class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Nombre d'utilisateurs
            </p>
            <p
                class="text-4xl font-semibold text-gray-700 dark:text-gray-200">
                <?php echo countUsers() . " utilisateurs"; ?>
            </p>
        </div>
        <div class="flex-1 flex justify-end">
            <a href="/admin/users_manage.php" class=" px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple ">Gérer les utilisateurs</a>
        </div>
    </div>
    <!-- Card -->
    <div
       class="flex items-center p-8 flex-wrap  gap-y-8   bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div
            class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M18 10c0 3.866-3.582 7-8 7a8.96 8.96 0 01-4.39-1.11L2 17l1.11-3.61A7.96 7.96 0 012 10c0-3.866 3.582-7 8-7s8 3.134 8 7zm-8-5a5 5 0 100 10 5 5 0 000-10zm-1 7h2v2h-2v-2zm0-6h2v5h-2V6z" />
            </svg>
        </div>
        <div>
            <p
                class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Les avis publiés
            </p>
            <p
                class="text-4xl font-semibold text-gray-700 dark:text-gray-200">
                <?php echo countComments() . " avis laissés"; ?>
            </p>
        </div>
        <div class="flex-1 flex justify-end">
            <a href="/admin/avis_manage.php" class=" px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple ">Gérer les commentaires</a>
        </div>
    </div>
    <!-- Card -->
    <div
       class="flex items-center p-8 flex-wrap  gap-y-8   bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div
            class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
            </svg>
        </div>
        <div>
            <p
                class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Les réservations
            </p>
            <p
                class="text-4xl font-semibold text-gray-700 dark:text-gray-200">
                <?php echo countReservations() . " réservations"; ?>
            </p>
        </div>
        <div class=" flex-1 flex justify-end">
            <a href="/admin/reservations_manage.php" class=" px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple ">Gérer les réservations</a>
        </div>
    </div>
    <!-- Card -->
    <div
       class="flex items-center p-8 flex-wrap  gap-y-8   bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div
            class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2.94 6.94A8 8 0 1117.06 17.06 8 8 0 012.94 6.94zm1.42 1.42A6 6 0 1016.24 16.24 6 6 0 004.36 8.36zm2.12 2.12a1 1 0 011.41 0l1.11 1.11 1.11-1.11a1 1 0 111.41 1.41l-1.82 1.82a1 1 0 01-1.41 0l-1.82-1.82a1 1 0 010-1.41z" />
            </svg>
        </div>
        <div>
            <p
                class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Les messages
            </p>
            <p
                class="text-4xl font-semibold text-gray-700 dark:text-gray-200">
                <?php echo countMessages() . " messages"; ?>
            </p>
        </div>
        <div class="flex-auto flex justify-end">
            <a href="/admin/messages_manage.php" class=" px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple ">Gérer les messages</a>
        </div>

    </div>
</div>

<div class="mt-4">
    <h3 class="text-2xl font-semibold mb-4 dark:text-white">Les infos sur l'événement</h3>

    <?php if ($event): ?>
        <div
            class="flex items-center gap-6 justify-between flex-wrap  p-6 bg-white rounded-lg shadow-xs dark:bg-gray-800">
          
            <div>
                <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Titre de l'événement
                </p>
                <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    <?php echo $event['title'] ?? 'Inconnu'; ?>
                </p>
            </div>

            <div>
                <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Organisateur
                </p>
                <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    <?php echo $event['organizer'] ?? 'Inconnu'; ?>
                </p>

            </div>

            <div>
                <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Nombre de places
                </p>
                <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    <?php echo $event['places_dispo'] ?? 0; ?>
                </p>
            </div>
            <div>
                <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Localisation
                </p>
                <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    <?php echo $event['location'] ?? 'Inconnue'; ?>
                </p>
            </div>


            <div class=" flex justify-end">
                <a href="/admin/event_manage.php" class=" px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple ">Gérer l'événement</a>
            </div>

        </div>
    <?php else: ?>
        <div class="p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <p class="text-gray-600 dark:text-gray-400">Aucun événement trouvé.</p>
        </div>
    <?php endif; ?>


</div>

<?php
require_once __DIR__ . '/partials/footer.php';
