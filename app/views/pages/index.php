<?php
require APPROOT . '/views/inc/header.php';

var_dump($_SESSION['user_id'], $_SESSION['user_role']);


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
           <?php if(isset($_SESSION['user_id'])) :?>
            <?php if ($_SESSION['user_role'] == 'Admin') :?>

                <div class="flex shrink-0">
                <a aria-current="page" class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo URLROOT; ?>/pages/index">
                    WiKiiii's
                </a>
                <a aria-current="page" class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo URLROOT; ?>/pages/adminD">
                    My-Configs
                </a>
                </div>

                <a class="hidden items-center justify-center rounded-xl bg-red-700 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset  transition-all duration-150 hover:bg-black sm:inline-flex"
                    href="<?php echo URLROOT; ?>/users/Logout">Logout</a>
                    <?php  elseif ($_SESSION['user_role'] == 'Author') : ?>
                <div class="flex shrink-0">
                <a aria-current="page" class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo URLROOT; ?>/pages/index">
                    WiKiiii's
                </a>
                <a aria-current="page" class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo URLROOT; ?>/pages/authorD">
                    My-Wiki's
                </a>
               
                </div>

                <a class="hidden items-center justify-center rounded-xl bg-red-700 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset  transition-all duration-150 hover:bg-black sm:inline-flex"
                    href="<?php echo URLROOT; ?>/users/Logout">Logout</a>
                    <?php  endif; ?>

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

<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div
        class="relative isolate overflow-hidden bg-white px-6 py-20 text-center sm:px-16 sm:shadow-sm dark:bg-transparent">
        <p class="mx-auto max-w-2xl text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-200 sm:text-4xl">
            Didn't find what you were looking for?
        </p>


        <form action="/search" id="searchWikiForm">
            <label
                class="mx-auto mt-8 relative bg-white min-w-sm max-w-2xl flex flex-col md:flex-row items-center justify-center border py-2 px-2 rounded-2xl gap-2 shadow-2xl focus-within:border-gray-300"
                for="search-bar">

                <input id="search-bar" placeholder="your keyword here" name="q"
                    class="px-6 py-2 w-full rounded-md flex-1 outline-none bg-white" required="">
                <button type="submit"
                    class="w-full md:w-auto px-6 py-3 bg-black border-black text-white fill-white active:scale-95 duration-100 border will-change-transform overflow-hidden relative rounded-xl transition-all">
                    <div class="flex items-center transition-all opacity-1">
                        <span class="text-sm font-semibold whitespace-nowrap truncate mx-auto">
                            Search
                        </span>
                    </div>
                </button>
            </label>
            
        </form>
    </div>
</div>


<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 ">
    <?php foreach ($data['wikis'] as $wiki) : ?>
        <?php if (!$wiki->isArchived) : ?>
        <div class="border border-gray-200 p-4 rounded-md shadow-lg shadow-grey-800 ">
            <h2 class="text-lg font-semibold mb-2"><?= $wiki->title; ?></h2>
            <p class="text-gray-700"><?= $wiki->content; ?></p>
            <p class="bg-blue-300 p-3 rounded-md"><?= $wiki->categoryId; ?></p>
            <div class="mt-4 flex justify-end ">
            <?php if(isset($_SESSION['user_id'])) :?>
                <?php if ($_SESSION['user_role'] == 'Author') :?>
                <!-- Edit button -->
                <a class="bg-blue-500 text-white px-4 py-2 rounded-md mr-2" href="<?= URLROOT ?>/categories/editWiki/<?= $wiki->wikiId; ?>">Edit</a>
                <!-- Delete button -->
                <form method="post" action="<?= URLROOT ?>/categories/deleteWiki/<?= $wiki->wikiId; ?>" onsubmit="return confirm('Are you sure you want to delete this wiki?');">
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md mr-2" type="submit">Delete</button>
                </form>
                <?php  elseif ($_SESSION['user_role'] == 'Admin') : ?>
                <!-- Archive button -->
                <form class="bg-black text-white px-4 py-2 rounded-md" action="<?= URLROOT; ?>/categories/archiveWiki/<?= $wiki->wikiId; ?>" method="post">
                    <button type="submit">Archive</button>
                </form>
                <?php  endif; ?>

            <?php  else : ?>

                <?php endif; ?>
                
            </div>
        </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>


<form action="<?= URLROOT; ?>/pages/search" method="post">
    <label for="search_title">Search by Title:</label>
    <input type="text" id="search_title" name="search_title" required>

    <!-- Display Search Suggestions -->
    <div id="search-suggestions"></div>

    <button type="submit">Search</button>
</form>

<!-- Include jQuery (you can use a CDN or download the library) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        // Handle keyup event on the search input
        $('#search_title').keyup(function () {
            // Get the search term
            var searchTerm = $(this).val();

            // Make an Ajax request to fetch suggestions
            $.ajax({
                type: 'GET',
                url: '<?= URLROOT; ?>/pages/searchSuggestions',
                data: { search_term: searchTerm },
                success: function (response) {
                    // Display suggestions in the suggestions container
                    $('#search-suggestions').html(response);
                }
            });
        });
    });
</script>

<?php
require APPROOT . '/views/inc/footer.php';
?>