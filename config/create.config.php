<?php
if (isset($_POST['submit'])) {
    require('config.php');
    $posted_set_name = htmlspecialchars($_POST['set_name']);
    if (!empty($posted_set_name)) { 
        $sql = "INSERT INTO flashcard_set(set_name) VALUES(?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$posted_set_name]);
        
        header('Location: ' . '../index.php');
        exit();
        
    } else {
        header('Location: ' . '../index.php?fields=empty');
        exit();
    }
}