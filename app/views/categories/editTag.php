<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <h2>Edit Tag</h2>
    <form action="<?php echo URLROOT; ?>/categories/editTag/<?php echo $data['tag']->tagId; ?>" method="post">
        <label for="tag_name">Tag Name:</label>
        <input type="text" id="tag_name" name="tag_name" value="<?php echo $data['tag']->name; ?>" required>
        <button type="submit">Update Tag</button>
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>