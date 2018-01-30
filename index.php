<?php 
    require('./config/config.php');
    $stmt = $pdo->query("SELECT * FROM flashcard_set");
    $sets = $stmt->fetchAll();
    $msg = '';
    if (isset($_GET['fields'])) {
        $msg = "Please fill in all fields.";
    }
?>

<?php include('./inc/header.php'); ?>

    <h1 class="text-center">Flashcard List</h1>
    <div class="list-group main__flashcard-list">
        <?php foreach ($sets as $set): ?>
            <a href="set.php?set_id=<?php echo $set['set_id']; ?>" class="list-group-item list-group-item-action"><?php  echo $set['set_name']; ?></a>
        <?php endforeach; ?>
    </div>

    <!-- Empty Field Warning -->
    <?php if ($msg != ''):  ?>
        <div class="alert alert-danger mt-3"><?php echo $msg; ?></div>
    <?php endif; ?>
    <!-- /Empty Field Warning -->
    
    <!-- Add set form -->
    <form 
        method="POST"
        action="config/create.config.php" 
        class="form add-set-form">
        <div class="form-group mt-3">
            <label for="user_set_name">Set Name</label>
            <input value="<?php  echo isset($set_id) ? $setName : '' ?>" type="text" name="set_name" id="user_set_name" class="form-control">
        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        <button type="button" class="btn btn-secondary form-cancel">Cancel</button>
    </form>
    <!-- /Add set form -->
    <div class="add-set mt-4 text-center">
        <button class="main__add-set show-form btn btn-primary">
            <i class="fa fa-plus-square" aria-hidden="true"></i>
            Add New Set
        </button>
    </div>

    <?php include('./inc/about.php'); ?>

    
<?php include('./inc/footer.php'); ?>