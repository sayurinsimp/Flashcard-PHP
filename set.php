<?php
    require('./config/config.php');
    $id = $_GET['set_id'];
    
    // Get set name based on ID
    $sql = "SELECT set_name FROM `flashcard_set` WHERE set_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $set = $stmt->fetch();
    $setName = $set['set_name'];

    // Get flashcard info
    $sql = "SELECT * FROM `$setName`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$setName]);
    $cards = $stmt->fetchAll();

    foreach ($cards as $card) {
        echo $card['question'] . '<br>';
        echo $card['answer'] . '<br>';
    }
?>