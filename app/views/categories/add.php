<!-- app/views/categories/add.php -->
<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <h2>Add Category</h2>
    <form action="<?php echo URLROOT; ?>/categories/add" method="post">
        <label for="name">Category Name:</label>
        <input type="text" name="name" required>
        <input type="submit" value="Add">
    </form>
    <a href="<?php echo URLROOT; ?>/categories">Back to Categories</a>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
