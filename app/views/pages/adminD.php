<?php
require APPROOT . '/views/inc/header.php';
?>

<header
    class="fixed inset-x-0 top-0 z-30 mx-auto w-full max-w-screen-md border border-gray-100 bg-white/80 py-3 shadow backdrop-blur-lg md:top-6 md:rounded-3xl lg:max-w-screen-lg">
    <div class="px-4">
        <div class="flex items-center justify-between">
            <div class="flex shrink-0">
                <a aria-current="page" class="flex items-center" href="/">
                    <img class="h-7 w-auto" src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" alt="">
                    <p class="sr-only">Website Title</p>
                </a>
            </div>
            <div class="flex shrink-0">
                <a aria-current="page" class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo URLROOT; ?>/pages/index">
                    WiKiiii's
                </a>
                <a aria-current="page" class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo URLROOT; ?>/pages/adminD">
                    My-Configs
                </a>
            </div>
           <?php if(isset($_SESSION['user_id'])) :?>
            <a class="hidden items-center justify-center rounded-xl bg-red-700 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset  transition-all duration-150 hover:bg-black sm:inline-flex"
                    href="<?php echo URLROOT; ?>/users/Logout">Logout</a>
            <?php  else : ?>
            <div class="flex items-center justify-end gap-3">
                <a class="hidden items-center justify-center rounded-xl bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 transition-all duration-150 hover:bg-gray-50 sm:inline-flex"
                    href="<?php echo URLROOT; ?>/users/register">Sign in</a>
                <a class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm transition-all duration-150 hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                    href="<?php echo URLROOT; ?>/pages/login">Login</a>
            </div>
            <?php  endif; ?>
        </div>
    </div>
</header>
<br><br><br>
    
</body>
</html>