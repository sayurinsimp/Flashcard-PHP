<!-- HEADER START -->

<?php include('./inc/header.php'); ?>

<!-- HEADER END -->

<!-- LISTS FLASHCARD DECKS -->
    <h1 class="text-center">Flashcard List</h1>
    <div class="list-group main__flashcard-list">
        <?php foreach ($sets as $set): ?>
            <a href="set.php?set_id=<?php echo $set['set_id']; ?>" class="list-group-item list-group-item-action"><?php  echo $set['set_name']; ?></a>
        <?php endforeach; ?>

        <!-- Empty Fields Message -->

        <?php include('inc/empty-fields.php'); ?>

        <!-- /Empty Fields Message -->
        
    </div>

    
    
    <!-- Add set form -->

    <?php include('inc/forms/add-set.form.php'); ?>

    <!-- /Add set form -->
    
    <div class="add-set mt-4 text-center">
        <button class="main__add-set show-form btn btn-primary">
            <i class="fa fa-plus-square" aria-hidden="true"></i>
            Add New Set
        </button>
    </div>

    <?php include('./inc/about.php'); ?>

    
<?php include('./inc/footer.php'); ?>