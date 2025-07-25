<?php if (!empty($_SESSION['successMessage']) || !empty($_SESSION['errorMessage']) || !empty($_SESSION['flash']['message'])): ?>

    <div class="items-center flex gap-4 justify-baseline p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple dark:bg-purple-700 dark:text-purple-200 max-w-screen-md w-full mx-auto">
        <svg
            class="w-5 h-5 mr-2"
            fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
        </svg>
        <?php
        if (!empty($_SESSION['successMessage'])) {
            echo htmlspecialchars($_SESSION['successMessage'], ENT_QUOTES, 'UTF-8');
        } elseif (!empty($_SESSION['errorMessage'])) {
            echo htmlspecialchars($_SESSION['errorMessage'], ENT_QUOTES, 'UTF-8');
        } elseif (!empty($_SESSION['flash']['message'])) {
            echo htmlspecialchars($_SESSION['flash']['message'], ENT_QUOTES, 'UTF-8');
        }
        ?>
       
    </div>

    <?php
    unset($_SESSION['successMessage']);
    unset($_SESSION['errorMessage']);
    unset($_SESSION['flash']['message']);

    endif; ?>