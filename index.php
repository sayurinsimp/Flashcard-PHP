<?php 
    require('./config/config.php');
    $stmt = $pdo->query("SELECT * FROM flashcard_set");
    $sets = $stmt->fetchAll();

?>
<?php include('./inc/header.php'); ?>
    <h1 class="text-center">Flashcard List</h1>
    <div class="list-group">
        <?php foreach ($sets as $set): ?>
            <a href="set.php?set_id=<?php echo $set['set_id']; ?>" class="list-group-item list-group-item-action"><?php  echo $set['set_name']; ?></a>
        <?php endforeach; ?>
    </div>
    
<?php include('./inc/footer.php'); ?>