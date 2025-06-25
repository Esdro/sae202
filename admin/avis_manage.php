<?php

$pageTitle = 'Gestion des avis';
$pageDescription = 'Page de gestion des avis du site de réservation de cinéma.';

require_once __DIR__ . '/partials/header.php';

?>


<?php

require_once "queries/avis.php";


$avis = getAllAvis();

?>


<div class="w-full overflow-hidden rounded-lg shadow-xs mt-8">
  <div class="w-full overflow-x-auto">
    <table class="w-full whitespace-no-wrap">
      <thead>
        <tr
          class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
          <th class="px-4 py-3">Utilisateur</th>
          <th class="px-4 py-3">Date</th>
          <th class="px-4 py-3">Statut</th>
          <th class="px-4 py-3">Contenu</th>
          <th class="px-4 py-3">Etoiles</th>
          <th class="px-4 py-3">Actions</th>
        </tr>
      </thead>
      <tbody
        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        <?php foreach ($avis as $avi) : ?>

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
                  <p class="font-semibold"> <?php echo htmlspecialchars($avi['author']); ?> </p>
                  <p class="text-xs text-gray-600 dark:text-gray-400">
                  <?php echo htmlspecialchars($avi['email']); ?> </p>
                  </p>
                </div>
              </div>
            </td>
            <td class="px-4 py-3 text-sm">
            <?php echo htmlspecialchars($avi['date']); ?>
            </td>
            <td class="px-4 py-3 text-xs">
              <span
                class="px-2 py-1 font-semibold leading-tight <?= $avi['statutClass']; ?> rounded-full">
                <?php echo htmlspecialchars($avi['statut']); ?>
              </span>
            </td>
            <td class="px-4 py-3 text-sm">
              <p class="text-gray-600 dark:text-gray-400">
                <?= $avi['content']; ?>
              </p>
            </td>
            <td class="px-4 py-3 text-sm">
              <p class="text-gray-600 dark:text-gray-400">
                <?= $avi['rate']; ?>
              </p>
            </td>
            <td class="px-4 py-3">
              <div class="flex items-center space-x-4 text-sm">
                <?php if ($avi['statut'] == 'En attente') : ?>
                  <a href="avis_action.php?action=approve&id=<?php echo $avi['id']; ?>" title="Approuver le commentaire"
                     class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                     aria-label="Publish">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20">
                      <path
                        fill-rule="evenodd"
                        d="M16.707 6.293a1 1 0 00-1.414 0L9 12.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 00-1.414-1.414z"
                        clip-rule="evenodd"></path>
                    </svg>
                    <span>Approuver</span>
                  </a>
             <?php elseif ($avi['statut'] == 'Approuvé') : ?>
                <a href="avis_action.php?action=disapprove&id=<?php echo $avi['id']; ?>" title="Désapprouver le commentaire"
                   class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                   aria-label="Edit">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20">
                      <path
                      fill-rule="evenodd"
                      d="M4.293 15.707a1 1 0 001.414 0L10 11.414l4.293 4.293a1 1 0 001.414-1.414L11.414 10l4.293-4.293a1 1 0 00-1.414-1.414L10 8.586 5.707 4.293a1 1 0 00-1.414 1.414L8.586 10l-4.293 4.293a1 1 0 000 1.414z"
                      clip-rule="evenodd"></path>
                    </svg>
                    <span>Désapprouver</span>
                </a>
                <?php elseif ($avi['statut'] == 'Rejeté') : ?>
                <a href="avis_action.php?action=restore&id=<?php echo $avi['id']; ?>" title="Restaurer le commentaire"
                   class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                   aria-label="Restaurer le commentaire">
                    <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                      fill-rule="evenodd"
                      d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6zm2 2h4v2H8V6zm0 4h4v2H8v-2z"
                      clip-rule="evenodd"/>
                    </svg>
                    <span>Restaurer</span>
                </a>

                <?php endif; ?>
                <?php if ($avi['statut'] != 'Rejeté') : ?>
                <a href="avis_action.php?action=reject&id=<?php echo $avi['id']; ?>" title="Rejeter le commentaire"
                   class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                   aria-label="Delete">
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                      fill-rule="evenodd"
                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                      clip-rule="evenodd"></path>
                  </svg>
                  <span>Rejeter</span>
                </a>
                <?php endif; ?>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
 
</div>



</div>



<?php

require_once __DIR__ . '/partials/footer.php';
