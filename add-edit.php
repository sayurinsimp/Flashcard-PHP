<?php
    require('./config/config.php');
    require('./config/query.php');
    require('./config/functions.php');

    $msg = '';
    $question_value = '';
    $answer_value = '';

    // Check if page loaded is a card edit
    if (isset($_GET['card_id'])) {
        $card_id = htmlspecialchars($_GET['card_id']);
        $sql = "SELECT * FROM `$setName` WHERE card_id = ?";
        $card = prepareAndExecute($sql, array($card_id), 'fetch');
        $question_value = $card['question'];
        $answer_value = $card['answer'];
    }

    // Delete card on submit
    if (isset($_POST['delete'])) {
        $sql = "DELETE FROM `$setName` WHERE card_id = ?";
        prepareAndExecute($sql, array($card_id));
        header('Location: ' . 'set.php?set_id=' . $set_id . '');
    } 
    // Add New Card
    if (isset($_POST['submit'])) {
        $question = htmlspecialchars($_POST['question']);
        $answer = htmlspecialchars($_POST['answer']);

        if (!empty($question) && !empty($answer)) {
            if (isset($_GET['card_id'])) {
                $sql = "UPDATE `$setName` SET question = ?, answer = ? WHERE card_id = ?";
                prepareAndExecute($sql, array($question, $answer, $card_id));
            } else {
                $sql = "INSERT INTO `$setName`(question, answer) VALUES(?, ?)";
                prepareAndExecute($sql, array($question, $answer));
            }
            header('Location: ' . 'set.php?set_id=' . $set_id . '');
        } else {
            $msg = 'Please fill in all fields';
        }
    }
?>

<?php include('./inc/header.php'); ?>

    <h1>Edit Card</h1>
    <?php include('./inc/form.php'); ?>

<?php include('./inc/footer.php'); ?>