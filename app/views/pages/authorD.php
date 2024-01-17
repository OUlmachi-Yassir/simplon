<?php
require APPROOT . '/views/inc/header.php';
if(!isset($_SESSION['user_id'])){
    redirect('users/login');
}

var_dump($wikis);

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
            <div class="flex shrink-0">
                <a aria-current="page" class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo URLROOT; ?>/pages/index">
                    WiKiiii's
                </a>
                <a aria-current="page" class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo URLROOT; ?>/pages/authorD">
                    My-Wiki's
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









<h1>Author Dashboard</h1>


<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($data['wikis'] as $wiki) : ?>
        <div class="border border-gray-200 p-4 rounded-md">
            <h2 class="text-lg font-semibold mb-2"><?= $wiki->title; ?></h2>
            <p class="text-gray-700"><?= $wiki->content; ?></p>
            <div class="mt-4 flex justify-end">
                <a class="bg-blue-500 text-white px-4 py-2 rounded-md mr-2" href="<?= URLROOT ?>/categories/editWiki/<?= $wiki->wikiId; ?>">Edit</a>
                <!-- Delete button -->
                <form method="post" action="<?= URLROOT ?>/categories/deleteWiki/<?= $wiki->wikiId; ?>" onsubmit="return confirm('Are you sure you want to delete this wiki?');">
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md" type="submit">Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>




<br><br><br>
<div class="max-w-screen-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Add a Wiki</h1>

    <form action="<?= URLROOT; ?>/pages/addWiki" method="post" id="addWikiForm" class="space-y-4">
        <input type="hidden" name="AuthorId" value="<?= $_SESSION['user_id'] ?? '' ?>">
        <div class="flex flex-col">
            <label for="title" class="text-lg font-medium mb-1">Title:</label>
            <input type="text" id="title" name="title" required
                class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div class="flex flex-col">
            <label for="content" class="text-lg font-medium mb-1">Content:</label>
            <textarea id="content" name="content" required
                class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring focus:border-blue-500"></textarea>
        </div>

        <div class="flex flex-col">
            <label for="category" class="text-lg font-medium mb-1">Category:</label>
            <select id="category" name="category" onchange="updateTags()"
                class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring focus:border-blue-500"
                required>
                <?php foreach ($data['categories'] as $category) : ?>
                    <option value="<?= $category->categoryId; ?>"><?= $category->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="flex flex-col">
            <label for="tags" class="text-lg font-medium mb-1">Tags:</label>
            <select id="tags" name="tags[]" multiple
                class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring focus:border-blue-500">
                <!-- Tags will be populated dynamically using JavaScript -->
            </select>
        </div>

        <button type="submit"
            class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-700">
            Add Wiki
        </button>
    </form>
</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function updateTags() {
        console.log("Category changed. Sending AJAX request...");
        var categoryId = $("#category").val();

        $.ajax({
            url: `<?= URLROOT; ?>/Tags/getTagsByIdCategories?idcate=${categoryId}` ,
            method: "GET",
            contentType: "application/json",
            success: function (data) {
            
                var tagsSelect = $("#tags");
                tagsSelect.empty(); // Clear existing options

                $.each(data, function (index, tag) {
                    var option = $("<option></option>")
                        .attr("value", tag.tagId)
                        .text(tag.name);
                    tagsSelect.append(option);
                });
            },
            error: function (error) {
                console.error("Error fetching tags:", error);
            }
        });
    }

    // Initialize tags on page load
    updateTags();

    // Attach the updateTags function to the category change event
    $("#category").on("change", updateTags);
</script>


</body>
</html>