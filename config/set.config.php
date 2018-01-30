<?php
    // Check if either a set name edit or new card was submitted
    if (isset($_POST['submit_set_name']) || isset($_POST['submit_card'])) {
        require('config.php');
        require('query.php');
        if (isset($_POST['submit_set_name'])) { 
            $editedName = htmlspecialchars($_POST['set_name']);
            // A set must have name
            if (!empty($editedName)) {
                $sql = "RENAME TABLE `$setName` TO `$editedName`";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([]);
    
                $sql = "UPDATE flashcard_set SET set_name = ? WHERE set_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$editedName, $set_id]);
                header('Location: ' . '../set.php?set_id=' . $set_id);
            } else {
                header('Location: ' . '../set.php?set_id=' . $set_id . '&fields=empty');
            }
        } else if (isset($_POST['submit_card'])) {
                $question = htmlspecialchars($_POST['question']);
                $answer = htmlspecialchars($_POST['answer']);
            if (!empty($question) && !empty($answer)) {
                $sql = "INSERT INTO `$setName`(question, answer) VALUES(?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$question, $answer]);
                header('Location: ' . '../set.php?set_id=' . $set_id);
            } else {
                header('Location: ' . '../set.php?set_id=' . $set_id . '&fields=empty');
            }
        }
    } else {
        header('Location: ' . '../index.php');
    }