<?php 
    require('./config/config.php');
    $stmt = $pdo->query("SELECT * FROM flashcard_set");
    $sets = $stmt->fetchAll();
?>

<?php include('./inc/header.php'); ?>
    <h1 class="text-center">Flashcard List</h1>
    <div class="list-group main__flashcard-list">
        <?php foreach ($sets as $set): ?>
            <a href="set.php?set_id=<?php echo $set['set_id']; ?>" class="list-group-item list-group-item-action"><?php  echo $set['set_name']; ?></a>
        <?php endforeach; ?>
    </div>
    <div class="add-set mt-4 text-center">
        <a href="new-set.php" class="main__add-set btn btn-primary">
            <i class="fa fa-plus-square" aria-hidden="true"></i>
            Add New Set
        </a>
    </div>
    <div class="main__about">
        <h4 class="text-center">About This Project</h4>
        <p>The purpose of this project is to practice PHP, PDO, and CRUD functionality.  As always, this project can be improved.  I appreciate any feedback and suggestions.</p>
        <p>Check out the <a href="https://github.com/xmtrinidad/Flashcard-PHP/blob/master/README.md">Readme</a> for documentation.</p>
    </div>
    
<?php include('./inc/footer.php'); ?>