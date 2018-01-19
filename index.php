<?php 
    require('./config/config.php');
    
    $stmt = $pdo->query("SELECT * FROM `flashcard_set`");

?>
<?php include('./inc/header.php'); ?>
    <h1 class="text-center">Flashcard List</h1>
    <div class="list-group">
        <?php 
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<a class="list-group-item list-group-item-action" href="set.php?set_id=' . $row['set_id'] . '">' . $row['set_name'] . '</a>';
            }
        ?>
    </div>
    
<?php include('./inc/footer.php'); ?>