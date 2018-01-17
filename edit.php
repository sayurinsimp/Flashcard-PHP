<?php
    require('./config/config.php');
    require('./config/query.php');

    // Get card info
    $card_id = htmlspecialchars($_GET['card_id']);
    $sql = "SELECT * FROM `$setName` WHERE card_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$card_id]);
    $card = $stmt->fetch();

    $msg = '';

    if (isset($_POST['submit'])) {
        $question = htmlspecialchars($_POST['question']);
        $answer = htmlspecialchars($_POST['answer']);

        if (!empty($question) && !empty($answer)) {
            $sql = "UPDATE `$setName` SET question = ?, answer = ? WHERE card_id = $card_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$question, $answer]);
            header('Location: ' . 'set.php?set_id=' . $set_id . '');
        } else {
            $msg = 'Please fill in all fields';
        }
    }

    if (isset($_POST['delete'])) {
        $sql = "DELETE FROM `$setName` WHERE card_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$card_id]);
        header('Location: ' . 'set.php?set_id=' . $set_id . '');
    }
?>

<?php include('./inc/header.php'); ?>

    <h1>Edit Card</h1>
    <?php include('./inc/form.php'); ?>

<?php include('./inc/footer.php'); ?>