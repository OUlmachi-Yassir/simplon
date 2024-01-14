<?php
require APPROOT . '/views/inc/header.php';

if(!isset($_SESSION['user_id'])){
    redirect('users/login');
}
?>

<header class="fixed inset-x-0 top-0 z-30 mx-auto w-full max-w-screen-md border border-gray-100 bg-white/80 py-3 shadow backdrop-blur-lg md:top-6 md:rounded-3xl lg:max-w-screen-lg">
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
            <?php if (isset($_SESSION['user_id'])) : ?>
                <a class="hidden items-center justify-center rounded-xl bg-red-700 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset  transition-all duration-150 hover:bg-black sm:inline-flex" href="<?php echo URLROOT; ?>/users/Logout">Logout</a>
            <?php else : ?>
                <div class="flex items-center justify-end gap-3">
                    <a class="hidden items-center justify-center rounded-xl bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 transition-all duration-150 hover:bg-gray-50 sm:inline-flex" href="<?php echo URLROOT; ?>/users/register">Sign in</a>
                    <a class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm transition-all duration-150 hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600" href="<?php echo URLROOT; ?>/pages/login">Login</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>
<br><br><br>





<br><br><br>
<h1 class=" flex justify-center text-xl font-bold text-black">Site Statistics</h1>
<br>

<div class="flex justify-center items-center  ">
    <!-- Wikis Card -->
    <div class="bg-blue-200 p-6 m-2 rounded-lg shadow-md">
        <h2 class="text-xl font-bold text-blue-700">Total Wikis</h2>
        <p class="text-lg text-gray-700"><?= $data['wikiCount'] ?? 'N/A'; ?></p>
    </div>

    <!-- Categories Card -->
    <div class="bg-green-200 p-6 m-2 rounded-lg shadow-md">
        <h2 class="text-xl font-bold text-green-700">Total Categories</h2>
        <p class="text-lg text-gray-700"><?= $data['categoryCount'] ?? 'N/A'; ?></p>
    </div>

    <!-- Authors Card -->
    <div class="bg-indigo-200 p-6 m-2 rounded-lg shadow-md">
        <h2 class="text-xl font-bold text-indigo-700">Total Authors</h2>
        <p class="text-lg text-gray-700"><?= $data['authorCount'] ?? 'N/A'; ?></p>
    </div>
</div>


<br><br><br>


<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Categories</h2>

    <?php if (!empty($data['categories'])) : ?>
        <ul class="list-disc pl-4">
            <?php foreach ($data['categories'] as $category) : ?>
                <li class="flex items-center justify-between border-b py-2">
                    <span><?php echo $category->name; ?></span>
                    
                    <div class="flex space-x-2">
                        <a href="<?php echo URLROOT; ?>/categories/edit/<?php echo $category->categoryId; ?>"
                            class="text-blue-500 hover:underline">Edit</a>

                        <form action="<?php echo URLROOT; ?>/categories/delete/<?php echo $category->categoryId; ?>"
                            method="post" class="inline">
                            <input type="submit" value="Delete"
                                class="text-red-500 hover:text-red-700 cursor-pointer">
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p class="mt-4">No categories available.</p>
    <?php endif; ?>

    <a href="<?php echo URLROOT; ?>/categories/add"
        class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Add Category</a>
</div>


<!--.............................-->
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Categories With there Tags</h2>

    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($data['categories'] as $category): ?>
            <li class="border p-4 mb-4">
                <div class="flex justify-between mb-2">
                    <span class="font-bold"><?php echo $category->name; ?></span>
                    <a href="<?php echo URLROOT; ?>/categories/edit/<?php echo $category->categoryId; ?>"
                        class="text-blue-500 hover:underline">Edit</a>
                </div>

                <?php $tags = $this->tagModel->getTagsByCategory($category->categoryId); ?>
                <ul class="list-disc pl-4">
                    <?php foreach ($tags as $tag): ?>
                        <li class="flex items-center justify-between">
                            <span><?php echo $tag->name; ?></span>
                            <div class="flex space-x-2">
                                <a href="<?php echo URLROOT; ?>/categories/editTag/<?php echo $tag->tagId; ?>"
                                    class="text-blue-500 hover:underline">Edit</a>

                                <form action="<?php echo URLROOT; ?>/categories/deleteTag/<?php echo $tag->tagId; ?>"
                                    method="post" class="inline">
                                    <input type="submit" value="Delete"
                                        class="text-red-500 hover:text-red-700 cursor-pointer">
                                </form>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <a href="<?php echo URLROOT; ?>/categories/addTag/<?php echo $category->categoryId; ?>"
                    class="mt-2 inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Add Tag</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>






<?php require APPROOT . '/views/inc/footer.php'; ?>