<!-- In your view file (editWiki.php) -->

<?php require APPROOT . '/views/inc/header.php'; 
print_r($data['wiki']);
echo $data['wiki']->title;
?>

<div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-6 bg-white rounded-md shadow-md md:max-w-lg lg:max-w-xl">
        <h1 class="text-2xl font-bold mb-6">Edit Wiki</h1>

        <form action="<?= URLROOT; ?>/categories/editWiki/<?= $data['wiki']->wikiId; ?>" method="post">
            <div class="mb-4">
                <label for="title" class="block text-sm font-semibold text-gray-600">Title:</label>
                <input type="text" id="title" name="title" value="<?= $data['wiki']->title; ?>" required
                    class="w-full mt-1 p-2 border rounded-md">
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-semibold text-gray-600">Content:</label>
                <textarea id="content" name="content" required
                    class="w-full mt-1 p-2 border rounded-md"><?= $data['wiki']->content; ?></textarea>
            </div>

            <div class="mb-4">
                <label for="category" class="block text-sm font-semibold text-gray-600">Category:</label>
                <select id="category" name="category" required
                    class="w-full mt-1 p-2 border rounded-md">
                    <?php foreach ($data['categories'] as $category) : ?>
                        <option value="<?= $category->categoryId; ?>"
                            <?= ($category->categoryId == $data['wiki']->categoryId) ? 'selected' : ''; ?>>
                            <?= $category->name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- You can add other fields or customize as needed -->

            <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                Update Wiki
            </button>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
