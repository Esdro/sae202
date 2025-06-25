<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "queries/events.php";
    $result = updateEventInfos($_POST);
    
    if ($result) {
        header("Location: /admin/event_manage.php?success=1");
        exit;
    } else {
        $error = "Une erreur s'est produite lors de la mise à jour de l'événement.";
    }
}



$pageTitle = "Gestion de l'événement";
$pageDescription = "Gérer les événements de l'application";

require_once "queries/events.php";
$event = getEventBySearch();

require_once __DIR__ . '/partials/header.php';
?>

<div class="container mx-auto px-4 py-8 flex flex-wrap !items-start  gap-6 justify-between ">

    <div class=" self-start  grid grid-cols-1 md:grid-cols-2  gap-6  bg-white rounded-lg shadow-xs dark:bg-gray-800 p-6 ">
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">ID de l'événement</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?php echo $event['id'] ?? 'Inconnu'; ?></p>
        </div>

        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Titre de l'événement</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?php echo $event['title'] ?? 'Inconnu'; ?></p>

        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Organisateur</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?php echo $event['organizer'] ?? 'Inconnu'; ?></p>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Nombre de places</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?php echo $event['places_dispo'] ?? 0; ?></p>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Localisation</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?php echo $event['location'] ?? 'Inconnue'; ?></p>
        </div>
    </div>

    <div class=" flex-1 flex  flex-col flex-wrap  p-6 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h3 class="dark:text-gray-200">Modifier l'événement</h3>

        <form action="/admin/event_manage.php" method="POST">
            <input type="hidden" name="event_id" value="<?php echo $event['id'] ?? ''; ?>">
            <div class="mb-4">
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Titre de l'événement
                    </span>
                    <input
                    type="text" id="title" name="title" required
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-100 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray p-4 rounded-md border-gray-100 bg-gray-100" value="<?php echo $event['title'] ?? ''; ?>" />
                    <span class="text-xs text-gray-600 dark:text-gray-400">
                        Il est important que le titre contienne 'Disco Murder' pour que l'événement soit visible dans l'application.
                    </span>
            </div>
            <div class="mb-4">
                <label for="organizer" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Organisateur</label>
                <input type="text" id="organizer" name="organizer" value="<?php echo $event['organizer'] ?? ''; ?>" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray p-4 rounded-md border-gray-100 bg-gray-100 " required>
            </div>
            <div class="mb-4">
                <label for="places_dispo" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Nombre de places</label>
                <input type="number" id="places_dispo" name="places_dispo" value="<?php echo $event['places_dispo'] ?? 0; ?>" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray p-4 rounded-md border-gray-100 bg-gray-100 " required>
            </div>
            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Localisation</label>
                <input type="text" id="location" name="location" value="<?php echo $event['location'] ?? ''; ?>" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray p-4 rounded-md border-gray-100 bg-gray-100" required>
            </div>
            <button type="submit" class="inline-flex items-center mt-4 px-4 py-2 bg-purple-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 dark:bg-purple-500 dark:hover:bg-purple-600 dark:focus:ring-offset-gray-800">Enregistrer les modifications</button>
        </form>

    </div>

</div>