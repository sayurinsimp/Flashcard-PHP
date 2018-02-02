<?php
    if (isset($_POST['submit_edit'])) {
        require('config.php');

        $card_id = htmlspecialchars($_POST['card_id']);
        $set_id = htmlspecialchars($_POST['set_id']);
        $set_name = htmlspecialchars($_POST['set_name']);
        $edit_question = htmlspecialchars($_POST['edit_question']);
        $edit_answer = htmlspecialchars($_POST['edit_answer']);

        if (!empty($edit_question) && !empty($edit_answer)) {
            $sql = "UPDATE cards SET question = ?, answer = ? WHERE card_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$edit_question, $edit_answer, $card_id]);
            header('Location: ' . '../set.php?set_id=' . $set_id);
            exit();
        } else {
            header('Location: ' . '../set.php?set_id=' . $set_id . '&fields=empty');
            exit();
        }
    }