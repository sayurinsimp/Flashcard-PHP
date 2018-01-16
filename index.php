<?php 
    require('./config/config.php');
    
    $stmt = $pdo->query("SELECT * FROM `flashcard_set`");

?>
<?php include('./inc/header.php'); ?>

    <h1>Flashcard List</h1>
    <ul>
        <?php 
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<li><a href="set.php?set_id=' . $row['set_id'] . '">' . $row['set_name'] . '</a></li>';
            }
        ?>
    </ul>

<?php include('./inc/footer.php'); ?>