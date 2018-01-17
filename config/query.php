<?php 
    $id = htmlspecialchars($_GET['set_id']);
    // Get set name based on ID
    $sql = "SELECT set_name FROM `flashcard_set` WHERE set_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $set = $stmt->fetch();
    $setName = $set['set_name'];
?>