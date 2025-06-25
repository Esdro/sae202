 
  <?php
              $current_page = basename($_SERVER['PHP_SELF']); 
           //   echo $current_page;
      ?>
 
 <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
            Disco Murder by Ollie 
          </a>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
              <?php if ($current_page === 'index.php') : ?>
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>

              <?php endif; ?>

              <a
                class="inline-flex items-center w-full text-sm font-semibold  <?= $current_page == "index.php" ? " text-gray-800 " : " text-gray-400 " ?>  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="/admin/index.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  ></path>
                </svg>
                <span class="ml-4">Accueil </span>
              </a>
            </li>
          </ul>
          <ul>
            <li class="relative px-6 py-3">

             <?php if ($current_page === 'avis_manage.php') : ?>
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>

              <?php endif; ?>

              <a
                class="inline-flex items-center w-full text-sm font-semibold  <?= $current_page == "avis_manage.php" ? " text-gray-800 " : " text-gray-400 " ?>  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="/admin/avis_manage.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                  ></path>
                </svg>
                <span class="ml-4">Les commentaires </span>
              </a>
            </li>
            <li class="relative px-6 py-3">

              <?php if ($current_page === 'reservations_manage.php') : ?>
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>

              <?php endif; ?>

              <a
                class="inline-flex items-center w-full text-sm font-semibold <?= $current_page == "reservations_manage.php" ? " text-gray-800 " : " text-gray-400 " ?> transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="/admin/reservations_manage.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                  ></path>
                </svg>
                <span class="ml-4">Les réservations</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <?php if ($current_page === 'messages_manage.php') : ?>
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <?php endif; ?>
              <a
                class="inline-flex items-center w-full text-sm font-semibold <?= $current_page == "messages_manage.php" ? " text-gray-800 " : " text-gray-400 " ?> transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="/admin/messages_manage.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <rect x="3" y="7" width="18" height="13" rx="2" ry="2"></rect>
                  <path d="M16 3v4M8 3v4M3 11h18"></path>
                </svg>     <span class="ml-4">Les messages</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <?php if ($current_page === 'event_manage.php') : ?>
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"  
              ></span>
              <?php endif; ?>
              <a
                class="inline-flex items-center w-full text-sm font-semibold  <?= $current_page == "event_manage.php" ? " text-gray-800 " : " text-gray-400 " ?> transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="/admin/event_manage.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"
                  ></path>
                </svg>
                <span class="ml-4">L'événement</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <?php if ($current_page === 'users_manage.php') : ?>
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"  
              ></span>
              <?php endif; ?>
              <a
                class="inline-flex items-center w-full text-sm font-semibold  <?= $current_page == "users_manage.php" ? " text-gray-800 " : " text-gray-400 " ?> transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="/admin/users_manage.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-7a4 4 0 11-8 0 4 4 0 018 0zm6 4a4 4 0 10-8 0 4 4 0 008 0z" />
                </svg>     <span class="ml-4">Les utilisateurs</span>
              </a>
            </li>
           
          </ul>
      
        </div>
      </aside>

  