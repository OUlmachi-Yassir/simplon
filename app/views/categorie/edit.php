<!-- app/views/categories/edit.php -->
<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <h2>Edit Category</h2>
    <form action="<?php echo URLROOT; ?>/categories/edit/<?php echo $data['category']->categoryId; ?>" method="post">
        <label for="name">Category Name:</label>
        <input type="text" name="name" value="<?php echo $data['category']->name; ?>" required>
        <input type="submit" value="Update">
    </form>
    <a href="<?php echo URLROOT; ?>/categories">Back to Categories</a>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
