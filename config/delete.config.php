<?php
    if (isset($_POST['delete'])) {
        require('config.php');
        $set_id = htmlspecialchars($_GET['set_id']);
        $set_name = htmlspecialchars($_POST['set_name']);
        
        $sql = "DELETE FROM flashcard_set WHERE set_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$set_id]);

        $sql = "DROP TABLE `$set_name`";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([]);

        header('Location: ' . '../index.php' . '');
        exit();
    }
?>