<?php
    // Check if either a set name edit or new card was submitted
    if (isset($_POST['submit_set_name']) || isset($_POST['submit_card'])) {
        require('config.php');

        // Query for set name
        $set_id = htmlspecialchars($_GET['set_id']);
        $sql = "SELECT set_name FROM flashcard_set WHERE set_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$set_id]);
        
        // Card is being edited
        if (isset($_POST['submit_set_name'])) { 
            $editedName = htmlspecialchars($_POST['set_name']);
            // A set must have name
            if (!empty($editedName)) {
                $sql = "UPDATE flashcard_set SET set_name = ? WHERE set_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$editedName, $set_id]);
                header('Location: ' . '../set.php?set_id=' . $set_id);
                exit();
            } else {
                header('Location: ' . '../set.php?set_id=' . $set_id . '&fields=empty');
                exit();
            }
        }
        // New card is being added 
        else if (isset($_POST['submit_card'])) {
                $question = htmlspecialchars($_POST['question']);
                $answer = htmlspecialchars($_POST['answer']);
            if (!empty($question) && !empty($answer)) {
                $sql = "INSERT INTO cards(question, answer, set_id) VALUES(?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$question, $answer, $set_id]);
                header('Location: ' . '../set.php?set_id=' . $set_id);
                exit();
            } else {
                header('Location: ' . '../set.php?set_id=' . $set_id . '&fields=empty');
                exit();
            }
        }
    } else {
        header('Location: ' . '../index.php');
        exit();
    }