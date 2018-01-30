<?php
if (isset($_POST['submit'])) {
    require('config.php');
    $posted_set_name = htmlspecialchars($_POST['set_name']);
    if (!empty($posted_set_name)) { 
        $sql = "INSERT INTO flashcard_set(set_name) VALUES(?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$posted_set_name]);

        $sql ="CREATE TABLE `$posted_set_name`(
        card_id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
        question VARCHAR( 150 ) NOT NULL, 
        answer VARCHAR( 150 ) NOT NULL);";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([]);
        header('Location: ' . '../index.php');
        
    } else {
        header('Location: ' . '../index.php?fields=empty');
    }
}