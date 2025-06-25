<?php

$pageTitle = 'Gestion des réservations';
$pageDescription = 'Page de gestion des réservations du site de réservation de cinéma.';
require_once "queries/reservations.php";
$reservations = getReservations();

require_once __DIR__ . '/partials/header.php';
?>

<div class="w-full overflow-hidden rounded-lg shadow-xs mt-8">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Utilisateur</th>
                    <th class="px-4 py-3">Date de réservation</th>
                    <th class="px-4 py-3">Nombre de places</th>
                    <th class="px-4 py-3">En groupe ?</th>
                    <th class="px-4 py-3">Statut</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php foreach ($reservations as $reservation) : ?>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <!-- Avatar with inset shadow -->
                                <div
                                    class="relative hidden w-8 h-8 mr-3 rounded-full md:block  ">
                                    <img
                                        class="object-cover w-full h-full rounded-full"
                                        src="https://avataaars.io/?avatarStyle=Transparent&topType=LongHairFro&accessoriesType=Blank&hairColor=Brown&facialHairType=Blank&clotheType=ShirtCrewNeck&clotheColor=Pink&eyeType=Default&eyebrowType=Default&mouthType=Default&skinColor=Brown"
                                        alt=""
                                        loading="lazy" />
                                    <div
                                        class="absolute inset-0 rounded-full shadow-inner"
                                        aria-hidden="true"></div>
                                </div>
                                <div>
                                    <p class="font-semibold"> <?php echo htmlspecialchars($reservation['author']); ?> </p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        <?php echo htmlspecialchars($reservation['email']); ?> </p>
                                    </p>
                                </div>
                            </div>

                        </td>
                        <td class="px-4 py-3"><?php echo htmlspecialchars($reservation['date']); ?></td>
                        <td class="px-4 py-3"><?php echo htmlspecialchars($reservation['nb_place']); ?></td>
                        <td class="px-4 py-3"><?php echo htmlspecialchars($reservation['is_group'] ? 'Oui' : 'Non'); ?></td>
                        <td>
                            <span
                                class="px-2 py-1 font-semibold leading-tight <?= $reservation['statutClass']; ?> rounded-full">
                                <?php echo htmlspecialchars($reservation['statut']); ?>
                            </span>
                        </td>
                        <td class="px-4 py-3">
                           <?php if ($reservation['is_confirmed'] == 0) : ?>
                            <a href="/admin/reservations_action.php?action=confirm&id=<?php echo $reservation['id']; ?>" class="text-blue-600 hover:text-blue-900">Confirmer</a>
                            <?php else : ?>
                            <a href="/admin/reservations_action.php?action=cancel&id=<?php echo $reservation['id']; ?>" class="text-red-600 hover:text-red-900">Annuler</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>





    <?php
    require_once __DIR__ . '/partials/footer.php';
