<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <h2>Add Tag</h2>
    <form action="<?php echo URLROOT; ?>/categories/addTag/<?php echo $data['categoryId']; ?>" method="post">
        <label for="tag_name">Tag Name:</label>
        <input type="text" id="tag_name" name="tag_name" required>
        <button type="submit">Add Tag</button>
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
